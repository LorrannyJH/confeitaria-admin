<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Auth\PasswordResetRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Auth\RecoverPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class ResetPasswordController extends Controller
{
    public function showRecoverPasswordForm()
    {
        $data = [
            'route' => ''
        ];

        return view('auth.forget', compact('data'));
    }

    public function sendRecoverLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('msg_error', 'Usuário não encontrado.');
        }

        $resetPasswordToken = Str::random(60);

        DB::beginTransaction();
        try {
            $user->reset_password_token = $resetPasswordToken;
            $user->save();

            $resetPasswordFormRoute = route('auth.show-reset-password-form', $resetPasswordToken);

            try {
                Mail::to($user->email)->send(new RecoverPassword($user->name, $resetPasswordFormRoute));
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
                return back()->with('msg_error', 'Erro ao enviar e-mail de recuperação de senha.');
            }

            DB::commit();

            return redirect()
                ->route('auth.login.index')
                ->with('success', 'Clique no link que enviamos em seu e-mail para redefinir a sua senha.');

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return back()->with('msg_error', 'Erro ao gerar o token de redefinição.');
        }
    }

    public function showResetPasswordForm($resetPasswordToken)
    {
        $user = User::where('reset_password_token', $resetPasswordToken)->first();

        if (!$user) {
            abort(404);
        }

        $data = [
            'reset_password_token' => $resetPasswordToken
        ];

        return view('auth.reset', compact('data'));
    }

    public function reset(PasswordResetRequest $request)
    {
        $user = User::where('reset_password_token', $request->reset_password_token)->first();

        if (!$user) {
            abort(404);
        }

        DB::beginTransaction();
        try {
            $user->password = $request->password;
            $user->reset_password_token = null;
            $user->save();

            DB::commit();

            return redirect()
                ->route('auth.login.index')
                ->with('msg_success', 'Senha redefinida com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('msg_error', 'Erro ao redefinir a senha.');
        }
    }
}

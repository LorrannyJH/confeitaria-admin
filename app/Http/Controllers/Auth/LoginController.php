<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $userExists = User::where('email', $request->email)->exists();

        if (!$userExists) {
            return redirect()
                ->route('auth.login.index')
                ->with('msg_error', 'Usuário não existe.');
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //se a autenticação for um sucesso
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard.index');
        }

        //se a autenticação falhar
        return redirect()->route('auth.login.index')->with('msg_error', 'Autenticação falhou.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login.index');
    }
}

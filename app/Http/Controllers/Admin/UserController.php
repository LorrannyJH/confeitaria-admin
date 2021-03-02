<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\{User, Role};
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::paginate(5)
        ];
        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        User::create($request->user);

        return redirect()
        ->route('admin.users.index')
        ->with('msg_success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('roles','user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->user);

        return redirect()
            ->route('admin.users.index')
            ->with('msg_success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('msg_success', 'Usuário deletado com sucesso!');
    }
}

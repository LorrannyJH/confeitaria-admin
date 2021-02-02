<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Order, Customer, Product};

class OrderController extends Controller
{
    public function index()
    {
        
        return view('admin.orders.index');
    }

    public function create()
    {
        $data = [
            'customers' => Customer::select('id', 'name')->get(),
            'products' => Product::all()
        ];

        return view('admin.orders.create', compact('data'));
    }

    // public function store(UserRequest $request)
    // {
    //     User::create($request->user);

    //     return redirect()
    //     ->route('admin.users.index')
    //     ->with('msg_success', 'Usuário criado com sucesso!');
    // }

    // public function edit(User $user)
    // {
    //     $roles = Role::all();

    //     return view('admin.users.edit', compact('roles','user'));
    // }

    // public function update(UserRequest $request, User $user)
    // {
    //     $user->update($request->user);

    //     return redirect()
    //         ->route('admin.users.index')
    //         ->with('msg_success', 'Usuário atualizado com sucesso!');
    // }

    // public function destroy(User $user)
    // {
        
    //     $user->delete();

    //     return redirect()
    //         ->route('admin.users.index')
    //         ->with('msg_success', 'Usuário deletado com sucesso!');
    // }
}

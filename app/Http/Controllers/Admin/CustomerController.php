<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\Admin\CustomerRequest;


class CustomerController extends Controller
{
    public function index()
    {
        $data = [
            'customers' => Customer::paginate(5)
        ];
        return view('admin.customers.index', compact('data'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->customer);
        $customer->address()->create($request->address);
        return redirect()
        ->route('admin.customers.index')
        ->with('msg_success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->customer);
        $customer->address()->update($request->address);

        return redirect()
            ->route('admin.customers.index')
            ->with('msg_success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Customer $customer)
    {
        if (count($customer->orders)) {
            return redirect()
                ->route('admin.customers.index')
                ->with(
                    'msg_error',
                    'Não é possível deletar este cliente pois ele possui pedidos cadastrados!'
                );
        }

        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('msg_success', 'Cliente deletado com sucesso!');
    }
}

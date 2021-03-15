<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'customer.name' => ['required'],
            'customer.phone' => ['required'],
            'address.cep' => ['required'],
            'address.street' => ['required'],
            'address.number' => ['required'],
            'address.district' => ['required'],
            'address.city' => ['required'],
            'address.uf' => ['required'],
            'address.complement' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'customer.name' => 'usuário',
            'customer.phone' => 'telefone',
            'address.cep' => 'CEP',
            'address.street' => 'rua',
            'address.number' => 'número',
            'address.district' => 'bairro',
            'address.city' => 'cidade',
            'address.uf' => 'UF',
            'address.complement' => 'complemento'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor informado no campo :attribute já existe.',
        ];
    }
}

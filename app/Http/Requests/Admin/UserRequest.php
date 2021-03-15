<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user') ? $this->route('user')->id : '';

        $rules = [
            'user.name' => ['required'],
            'user.email' => ['required', 'email', 'unique:users,email,'.$userId.',id'],
        ];

        if ($this->method() == 'POST') {
            $rules['user.role_id'] = ['required'];
            $rules['user.password'] = ['required', 'confirmed'];
        } else {
            $rules['user.password'] = ['sometimes', 'confirmed'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'user.name' => 'usuário',
            'user.email' => 'email',
            'user.password' =>  'senha',
            'user.role_id' => 'papel',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor informado no campo :attribute já existe.',
            'user.email' => 'O email informado é inválido.',
            'confirmed' => 'As senhas devem ser iguais.'
        ];
    }
}

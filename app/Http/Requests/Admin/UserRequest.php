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

        return [
            'user.name' => ['required'],
            'user.email' => ['required', 'email', 'unique:users,email,'.$userId.',id'],
            'user.role_id' => ['required'],
            'user.password' => ['required', 'confirmed'],
        ];
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

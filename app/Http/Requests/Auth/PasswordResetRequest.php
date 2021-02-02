<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => ['required', 'string', 'min:6', 'max:16', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'As senhas não coincidem.'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'senha',
        ];
    }
}

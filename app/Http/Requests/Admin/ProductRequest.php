<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'product.name' => ['required'],
            'product.price' => ['required'],
            'product.description' => ['max:140'],
            'product.photo' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'product.name' => 'usuário',
            'product.price' => 'telefone',
            'product.description' => 'descrição',
            'product.photo' => 'foto'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor informado no campo :attribute já existe.',
            'max' => 'O campo :attribute deve conter no máximo 140 caracteres',
            'mimes' => 'O campo :attribute deve ser do tipo PNG ou JPG'
        ];
    }
}

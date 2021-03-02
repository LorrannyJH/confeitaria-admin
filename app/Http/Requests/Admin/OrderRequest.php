<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'order.delivery_date' => ['required', 'date_format:d/m/Y'],
            'order.delivery_hour' => ['required', 'date_format:H:i'],
            'order.customer_id' => ['required'],
            'order.product' => ['required', 'min:1'],
            'order.product.*.quantity' => ['required']
            
        ];
    }

    public function attributes()
    {
        return [
            'order.delivery_date' => 'data de entrega',
            'order.delivery_date' => 'hora de entrega',
            'order.customer_id' => 'cliente',
            'order.product.*' => 'produto'
            
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'date_format' => 'Os dados do campo :attribute não correspondem ao formato D/M/A H:M',
            'order.product.required' => 'Informe ao menos um produto',
            'order.product.*.quantity.required' => 'Informe a quantidade do produto'
            // 'unique' => 'O valor informado no campo :attribute já existe.',
            // 'max' => 'O campo :attribute deve conter no máximo 140 caracteres',
            // 'mimes' => 'O campo :attribute deve ser do tipo PNG ou JPG'
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order.delivery_date' => ['required'],
            'order.delivery_hour' => ['required'],
            'order.customer_id' => ['required', 'exists:customers,id'],
            'order.product' => 'required',
            'order.product.*.id' => ['required'],
            'order.product.*.quantity' => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'order.delivery_date' => 'data de entrega',
            'order.delivery_hour' => 'hora de entrega',
            'order.customer_id' => 'cliente',
            'order.product' => 'produto',
            'order.product.*.id' => 'produto',
            'order.product.*.quantity' => 'quantidade'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.'
        ];
    }
}

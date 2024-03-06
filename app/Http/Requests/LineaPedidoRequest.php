<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LineaPedidoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'precio' => ['required', 'numeric'],
            'stock' => ['required', 'integer'], //'max:productos,stock'

            'producto_id' => ['required', 'integer','exists:productos,id'],
            'pedido_id' => ['required', 'uuid', 'exists:pedido,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

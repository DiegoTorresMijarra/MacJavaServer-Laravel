<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'estado' => ['required'],
            'precioTotal' => ['required', 'numeric'],
            'stockTotal' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

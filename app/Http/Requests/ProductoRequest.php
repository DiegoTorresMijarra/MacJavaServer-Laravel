<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'descripcion' => ['required'],
            'imagen' => ['required'],
            'stock' => ['required', 'integer'],
            'precio' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required','min:4','max:20'], //podria ponerle unique:productos ... pero chequear luego
            'precio' => ['required', 'numeric','min:0.01'],
            'stock' => ['required', 'integer','min:1'],
            'descripcion' => ['required','min:4','max:250'],
            'categoria_id' => ['required','integer','exists:categorias,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

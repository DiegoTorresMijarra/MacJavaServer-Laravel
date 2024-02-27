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
            'stock' => ['required', 'integer','min:0'],
            'descripcion' => ['required','min:4','max:250'],
            //'imagen' => ['required','url'],

            'categoria_id' => ['required','uuid'],//'exists:categorias' o checkear luego
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required', Rule::in(Categoria::$NOMBRES_VALIDOS)],        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

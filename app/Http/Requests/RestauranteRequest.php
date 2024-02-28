<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestauranteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'capacidad' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

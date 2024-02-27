<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrabajadorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'nomina' => ['required', 'numeric'],
            'puesto' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

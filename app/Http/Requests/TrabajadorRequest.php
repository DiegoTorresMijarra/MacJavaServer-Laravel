<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrabajadorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required','string','min:4','max:20'],
            'apellidos' => ['required','string','min:4','max:20'],
            'nomina' => ['required', 'numeric','min:1100'],
            'puesto' => ['required', 'string','min:4','max:20'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

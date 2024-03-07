<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrabajadorRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'nombre' => ['required','string','min:4','max:20'],
            'apellidos' => ['required','string','min:4','max:20'],
            'dni'=>['required','string','regex:/^\d{8}[A-Za-z]$/i', Rule::unique('trabajadores')->ignore($this->route('trabajador'))],
            'nomina' => ['required', 'numeric','min:1100'],
            'puesto' => ['required', 'string','min:4','max:20'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
    public function messages(): array
    {
        return [
            'dni.regex' => 'El campo DNI debe ser un número de identificación válido.',
            'dni.unique' => 'El DNI ingresado ya está en uso.',
        ];
    }
    public function validar()
    {
        $this->validate($this->rules());

    }
}

<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class DireccionPersonalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pais' => ['required', 'string', 'max:250'],
            'provincia' => ['required', 'string', 'max:250'],
            'municipio' => ['required', 'string', 'max:250'],
            'codigoPostal' => ['required', 'string', 'max:250'],
            'calle' => ['required', 'string', 'max:250'],
            'numero' => ['required', 'string', 'max:250'],
            'portal' => ['nullable', 'string', 'max:250'],
            'infoAdicional' => ['nullable', 'string', 'max:250'],
            'piso' => ['nullable', 'string', 'max:250'],
            'nombre' => ['required', 'string', 'max:250'],
            'apellidos' => ['required', 'string', 'max:250'],

            'user_id' => ['nullable', 'exists:users,id', Rule::in([Auth::id()])]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'user_id.in' => 'El usuario del request y el que esta loggueado, deben ser el mismo',
        ];
    }
}

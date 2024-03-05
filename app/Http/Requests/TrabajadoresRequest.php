<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrabajadoresRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'userId' => ['required'],
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'nomina' => ['required'],
            'puesto' => ['required|in:Administrador,Gerente,Camarero,Limpieza,Cocinero'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

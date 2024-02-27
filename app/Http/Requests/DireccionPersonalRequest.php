<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionPersonalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'direccion' => ['required'],
            'nombre' => ['required'],
            'apellido' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

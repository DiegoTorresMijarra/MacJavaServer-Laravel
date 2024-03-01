<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'], //transformar su NombreApellidos . dos digitos dni . macjava
            'email' => ['required', 'email', 'max:254'], //crear email con name@macjava.com por ejemplo
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['required'], //password dni / rnd string
            'remember_token' => ['nullable'],
            'rol'=>[Rule::in(User::$ROLES_ENUM)]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

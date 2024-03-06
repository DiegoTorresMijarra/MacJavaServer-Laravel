<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],//transformar su NombreApellidos . dos digitos dni . macjava
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],//crear email con name@macjava.com por ejemplo
            'password' => ['required', 'string', 'min:8', 'confirmed'], //password dni / rnd string
            //'email_verified_at' => ['nullable', 'date'],
            //'remember_token' => ['nullable'],
            // 'rol'=>['nullable', Rule::in(User::$ROLES_ENUM)] // lo dejo por defecto o trabajador en el de admin
            'avatar'=>['nullable', 'image','mimes:jpeg,png,jpg,gif,svg','max:2048']
        ];
    }


    public function authorize(): bool
    {
        return true;
    }

    public function validarYTransformar()
    {
            $this->merge([
                'password' => Hash::make($this->password),
            ]);
            return $this;
    }
}

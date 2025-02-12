<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)->letters()->symbols()->numbers()
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya está registrado',
            'email.email' => 'El email debe ser válido',
            'password' => 'La contraseña debe tener al menos 8 caracteres, un número y un símbolo',
            'password.confirmed' => "Las contraseñas no coinciden",

        ];
    }
}

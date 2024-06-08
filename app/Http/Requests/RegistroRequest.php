<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)
                ->letters()
                ->numbers()
                ->symbols()
            ]
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El Nombre es obligatorio',
            'email.required' => 'El Email es obligatorio',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El usuario ya esta registrado',
            'password' => 'El password debe contener al menos 8 caracteres, un simbolo y un número'
        ];
    }
}

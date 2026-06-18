<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'senha' => 'required|min:6|string'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'email.required' => 'O email é obrigatorio',
            'email.email' => 'Formato de email invalido',
            'senha.required' => 'A senha é obrigatoria',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email',
            'senha' => 'senha',
        ];
    }
}
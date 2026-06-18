<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nome" => "required|string|max:255",
            "idade" => "required|integer|min:0|max:255",
            "email" => "required|email|unique:tb_usuarios,email",
            "senha" => "required|string|min:6",
            "cpf" => "required|string|unique:tb_usuarios,cpf"
        ];
    }

    public function messages(): array
    {
        return [
            "nome.required" => "O nome é obrigatório",
            "nome.string" => "O nome deve ser uma string",
            "nome.max" => "O nome deve ter no máximo 255 caracteres",
            "idade.required" => "A idade é obrigatória",
            "idade.integer" => "A idade deve ser um número inteiro",
            "idade.min" => "A idade deve ser maior ou igual a 0",
            "idade.max" => "A idade deve ser menor ou igual a 255",
            "email.required" => "O email é obrigatório",
            "email.email" => "Formato de email inválido",
            "email.unique" => "O email já está cadastrado",
            "senha.required" => "A senha é obrigatória",
            "senha.string" => "A senha deve ser uma string",
            "senha.min" => "A senha deve ter no mínimo 6 caracteres",
            "cpf.required" => "O cpf é obrigatório",
            "cpf.string" => "O cpf deve ser uma string",
            "cpf.unique" => "O cpf já está cadastrado"
        ];
    }

    public function attributes(): array
    {
        return [
            'nome' => 'nome',
            'idade' => 'idade',
            'email' => 'email',
            'senha' => 'senha', 
            'cpf' => 'cpf'
        ];
    }
}

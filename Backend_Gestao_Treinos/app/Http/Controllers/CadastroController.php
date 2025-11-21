<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CadastroService;
use Exception;


class CadastroController extends Controller
{

    public function __construct(
        private CadastroService $cadastroService
    ){}
    
    public function getregister()
    {
        return view("/cadastro");
    }
    
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
            "nome" => "required|string|max:255",
            "idade" => "required|integer|min:0|max:255",
            "email" => "required|email|unique:pessoa_treino,email",
            "senha" => "required|string|min:6",
            "cpf" => ["required", "string", "unique:pessoa_treino,cpf", 
            function($attribute, $value, $fail){

                // Validação basica de cpf
                if(strlen($value) !== 11){
                    $fail("cpf deve ter 11 digitos");
                }

            }]
        ]);

            $pessoaTreino = $this->cadastroService->create($validated);
            
            if (!$pessoaTreino){
                return response()->json([
                    "erro" => "erro campo vazio",
                    "data" => "sem dados"
                ], 404);
            }
            
            return response()->json([
                "sucesso" => "sucesso na requesição",
                "data" => $pessoaTreino
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "erro" => "erro ao criar o usuario",
                "mensagem" => $e->getMessage()
            ], 500);
        }
        
    }
}       
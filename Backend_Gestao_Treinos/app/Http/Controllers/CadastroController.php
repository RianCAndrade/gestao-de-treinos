<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Service\CadastroService;
use Illuminate\Http\Request;
use Exception;


class CadastroController extends Controller
{

    public function __construct(
        private CadastroService $cadastroService
    ){}
    
    public function register(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();
        // dd($validated);

            $usuario = $this->cadastroService->create($validated);
            if (!$usuario){
                return response()->json([
                    "erro" => "erro campo vazio",
                    "data" => "sem dados"
                ], 404);
            }
            
            return response()->json([
                "sucesso" => true,
                "data" => $usuario
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "erro" => "erro ao criar o usuario",
                "mensagem" => $e->getMessage()
            ], 500);
        }
        
    }
}       
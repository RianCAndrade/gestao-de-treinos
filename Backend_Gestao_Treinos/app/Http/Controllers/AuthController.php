<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Service\AuthService;
use Illuminate\Http\Request;
// use Exception;
use Sentry\Exception\JsonException;

// use function Termwind\render;

class AuthController extends Controller 
{
    
    public function __construct(
        private AuthService $authService
    ){}

    // public function index(Request $request)
    // {
    //     return render("/conteudo");
    // }

    public function login(LoginRequest $request)
    {
        try 
        {
            $validated = $request->validated();

            $result = $this->authService->authenticate($validated);


            if(!$result["sucesso"]){
                return response()->json([
                    "error" => "Credenciais Invalidas",
                    "mensagem" => "Email ou senha incorretos"
                ], 401);
            }

            // $request->session()->regenerate();
            return response()->json([
                "sucesso" => true,
                "mensagem" => "Login realizado com sucesso",
                "token" => $result["token"],
                "data" => $result["user"],
            ]);
        } catch (JsonException $e) {
            return response()->json([
                "sucesso" => false,
                "mensagem" => "Erro interno do servidor",
                "error" => $e->getMessage()
            ], 500);
        }
    }

}

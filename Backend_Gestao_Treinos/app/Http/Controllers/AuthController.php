<?php

namespace App\Http\Controllers;

use App\Service\AuthService;
use Illuminate\Http\Request;
use Exception;

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

    public function login(Request $request)
    {
        try 
        {
            $validated = $request->validate([
                "email" => "required|email",
                "senha" => "required|min:6",
            ]);

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
        } catch (Exception $e) {
            return response()->json([
                "sucesso" => false,
                "mensagem" => "Erro interno do servidor",
                "error" => $e->getMessage()
            ], 500);
        }
    }

}

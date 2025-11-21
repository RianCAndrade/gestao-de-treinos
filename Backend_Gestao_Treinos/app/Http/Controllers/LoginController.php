<?php

namespace App\Http\Controllers;

use App\Service\LoginService;
use Illuminate\Http\Request;
use Exception;


class LoginController extends Controller {
    
    public function __construct(
        private LoginService $loginService
    ){}

    // public function index(Request $request)
    // {
    //     return render("/login");
    // }

    public function login(Request $request)
    {
        try 
        {
            $validated = $request->validate([
                "email" => "required|email",
                "senha" => "required|min:6",
            ]);

            $result = $this->loginService->authenticate($validated);
            
            if(!$result){
                return response()->json([
                    "mensagem" => $result["mensagem"]
                ], 401);
            }
            
            return response()->json([
                "mensagem" => $result,
                "data" => $result["user"]
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

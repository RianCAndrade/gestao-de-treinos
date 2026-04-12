<?php

namespace App\Http\Controllers;

use App\Http\Service\UsuarioService;
use Exception;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Request;

class UsuarioController 
{
    public function __construct(
        private UsuarioService $usuarioService
    ){}

    public function usuario($id)
    {
        try {
            $result = $this->usuarioService->usuario($id);

            if (!$result){
                return response()->json([
                    'error' => false,
                    'message' => 'usuario nao encontrado'
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'usuario encontrado com sucesso',
                'data' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'falha ao trazer usuario', $e->getMessage()
            ], 500);
        }
    }

    public function usuarioDelete($id)
    {
        try {
            $result = $this->usuarioService->usuarioDelete($id);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'falha ao deletar ou usuario nao encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'usuario deletado com sucesso',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
        

    }

    public function usuarioUpdate(Request $request, int $id)
    {
        // dd('ddd');
        try {
            $validated = $request->validate([
                "nome"  => "sometimes|required|string|max:255",
                "idade" => "sometimes|required|string|max:255",
                "email" => "sometimes|required|string|max:255",
                "senha" => "sometimes|required|string|max:255",
                "cpf"   => "sometimes|required|string|max:255"
            ]);

            // dd($validated);

            $result = $this->usuarioService->usuarioUpdate($validated, $id);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'usuario inexistente'
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'usuario atualizado com sucesso',
                'data' => $result,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Erro inesperado tente novamente mais tarde". $e->getMessage()
            ], 500);
        }
    }
}
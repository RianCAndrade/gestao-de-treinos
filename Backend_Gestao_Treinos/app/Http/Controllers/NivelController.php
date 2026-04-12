<?php

namespace App\Http\Controllers;

use App\Http\Service\NivelService;
use Illuminate\Http\Request;

class NivelController 
{
    public function __construct(
        private NivelService $nivelService
    ){}

    public function inserirNivel(Request $request)
    {
        try {
            $validated = $request->validate([
                'nivel' => 'required|array|max:255'
            ]);
            
            $result = $this->nivelService->inserirNivel($validated);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'Não foi possivel cadastrar nivel de exercicio'
                ], 422);
            }

            return response()->json([
                'error' => false,
                'message' => 'Nivel de Exercicio inserido com sucesso'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'erro inesperado '. $e->getMessage()
            ], 500);
        }
    }

    public function deletarNivel(int $id)
    {
        try {
            $result = $this->nivelService->deletarNivel($id);

            if (!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'nivel de exercicio não encontrado'
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'item deletado com sucesso'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'erro inesperado '. $e->getMessage()
            ], 500);
        }
    }
}
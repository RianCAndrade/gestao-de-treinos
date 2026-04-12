<?php

namespace App\Http\Controllers;

use App\Http\Service\ModalidadeService;
use Exception;
use Illuminate\Http\Request;

class ModalidadeController 
{
    public function __construct(
        private ModalidadeService $modalidadeService
    ){}

    public function inserirModalidade(Request $request)
    {
        try {
            $validated = $request->validate([
                'nome' => 'required|string|max:255'
            ]);

            $result = $this->modalidadeService->inserirModalidade($validated);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'Erro ao inserir exercicio'
                ], 422);
            }
            
            return response()->json([
                'error' => false,
                'message' => 'Modalidade cadastrado com sucesso'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'erro inesperado '. $e->getMessage()
            ], 500);
        }
    }

    public function deletarModalidade(int $id)
    {
        try {
            $result = $this->modalidadeService->deletarModalidade($id);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'Não foi possivel deletar'
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Modalidade Deletado com sucesso'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'erro inesperado '. $e->getMessage()
            ], 500);
        }
    }
}
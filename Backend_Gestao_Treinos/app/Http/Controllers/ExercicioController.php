<?php

namespace App\Http\Controllers;

use App\Service\ExercicioService;
use Exception;
use Illuminate\Http\Request;

class ExercicioController 
{
    public function __construct(
        private ExercicioService $exercicioService
    ){}

    public function getExercicios()
    {
        try {
            $result = $this->exercicioService->getExercicios();
            // dd($result);

            if ($result->isEmpty()) {
                return response()->json([
                    "success" => false,
                    "message" => "Nenhum exercício encontrado"
                ], 404);
            }

            return response()->json([
                "success" => "Sucesso na requesição",
                "message" => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage()
            ], 500);
        }
        
    }

    public function Modalidade(Request $request)
    {
        try {

            $result = $this->exercicioService->getByModalidade($request);

            // $modalidade = $result->fk_modalidade;

            if($result->isEmpty()){
                return response()->json([
                    "success" => false,
                    "error" => "Modalidade inexistente"
                ], 404);
            }

            return $result;
        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro inesperado",
                "error" => $e->getMessage()
            ], 500);
        }
    }


    public function searchExercicio(Request $request)
    {
        try {
            $search = $request->get('search');

            $result = $this->exercicioService->searchExercicio($search);

            if($result?->isEmpty()){
                return response()->json([
                    "success" => false,
                    "message" => "Nada encontrado"
                ], 404);
            }

            return response()->json([
                "success" => "valor encontrado",
                "message" => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error inesperado",
                "error" => $e->getMessage()
            ], 500);
        }

    }

    public function detalheExercicio($id)
    {

        try {
            $result = $this->exercicioService->detalheExercicio($id);

            if(!$result){
                return response()->json([
                    'success' => true,
                    'message' => 'exercicio não encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'exercicio encontrado',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Erro inesperado". $e->getMessage()
            ], 500);
        }
        
    }
    public function inserirExercicio(Request $request)
    {
        try {
            $validated = $request->validate([
                'titulo' => 'required|string|max:255',
                'descricao' => 'required|string',
                'fk_modalidade' => 'required|integer',
                'fk_nivel' => 'required|string|max:255',
                'video_url' => 'required|string|max:255',
                'imagem_url' => 'required|string|max:255',
                'ativo' => 'required|boolean',
            ]);

            $result = $this->exercicioService->inserirExercicio($validated);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'erro ao publicar exercicio'
                ], 400);
            }

            return response()->json([
                'error' => false,
                'message' => 'exercicio publicado com sucesso'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'erro inesperado '. $e->getMessage()
            ], 500);
        }
    }

    public function deletarExercicio(int $id)
    {
        try {
            $result = $this->exercicioService->deletarExercicio($id);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'não encontrado exercicio para deletar'
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Exercicio deletado com sucesso'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error inesperado ', $e->getMessage()
            ], 500);
        }
    }
}
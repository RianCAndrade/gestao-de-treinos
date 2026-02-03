<?php

namespace App\Http\Controllers;

use App\Service\ExercicioService;
use Exception;
use Symfony\Component\HttpFoundation\Request;

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

    public function getByModalidade(Request $request)
    {
        try {

            // dd($request);
            // $dados = $request->fk_modalidade

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
}
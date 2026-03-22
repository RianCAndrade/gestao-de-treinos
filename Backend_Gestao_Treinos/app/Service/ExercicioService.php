<?php

namespace App\Service;

use App\Repository\ExercicioRepository;

class ExercicioService 
{
    public function __construct(
        private ExercicioRepository $exercicioRepository
    ){}

    public function getExercicios()
    {
        $dados = $this->exercicioRepository->findAllExercicios();
        // dd($result);

        // if (empty($result) || $result === false){
        //     return [
        //         "success" => false,
        //         "message" => "Error nenhum exercicio encontrado"
        //     ];
        // }

        return $dados;
    }

    public function getByModalidade($modalidade)
    {
        $mod = $modalidade->fk_modalidade;
        // dd($mod);
        $dados = $this->exercicioRepository->findByModalidade($mod);
        // dd($result);

        // if ($result->is_Empty()){
        //     return [
        //         "success" => false,
        //         "message" => "modalidade não existe"
        //     ];
        // }

        return $dados;
    }

    public function searchExercicio($search)
    {
        $dados = $this->exercicioRepository->searchExercicio($search);

        return $dados;
    }

    public function detalheExercicio($id)
    {
        $dados = $this->exercicioRepository->detalheExercicios($id);

        return $dados;

    }

    public function inserirExercicio(array $dados)
    {
        return $this->exercicioRepository->inserirExercicios($dados);
    }

    public function deletarExercicio(int $id)
    {
        return $this->exercicioRepository->deletarExercicio($id);
    }
}
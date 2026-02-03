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
        $result = $this->exercicioRepository->findAllExercicios();
        // dd($result);

        // if (empty($result) || $result === false){
        //     return [
        //         "success" => false,
        //         "message" => "Error nenhum exercicio encontrado"
        //     ];
        // }

        return $result;
    }

    public function getByModalidade($modalidade)
    {
        $mod = $modalidade->fk_modalidade;
        // dd($mod);
        $result = $this->exercicioRepository->findByModalidade($mod);
        // dd($result);

        // if ($result->is_Empty()){
        //     return [
        //         "success" => false,
        //         "message" => "modalidade não existe"
        //     ];
        // }

        return $result;
    }
}
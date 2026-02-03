<?php

namespace App\Repository;

use App\Models\Exercicio;

class ExercicioRepository 
{

    public function __construct(
        private Exercicio $exercicio
    )
    {}

    public function findAllExercicios()
    {
        return $this->exercicio::all();
    }

    public function findByModalidade($modalidade)
    {
        return $this->exercicio::where('fk_modalidade', $modalidade)->get();
    }

}
<?php

namespace App\Http\Repository;

use App\Models\Nivel;

class NivelRepository
{
    public function __construct(
        private Nivel $nivel
    ){}

    public function inserirNivel(array $dados)
    {

        foreach ($dados as $nivel){
            $this->nivel->create($nivel);
        }
        
        return true;
    }

    public function deletarNivel(int $id)
    {
        return $this->nivel->where('id', $id)->delete();
    }
}
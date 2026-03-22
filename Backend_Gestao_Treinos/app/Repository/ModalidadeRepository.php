<?php


namespace App\Repository;

use App\Models\Modalidade;

class ModalidadeRepository 
{
    public function __construct(
        private Modalidade $modalidade
    ){}

    public function inserirModalidade($dados)
    {
        return $this->modalidade->create($dados);
    }

    public function deletarModalidade(int $id)
    {
        return $this->modalidade->where('id', $id)->delete();
    }
}
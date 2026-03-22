<?php

namespace App\Service;

use App\Repository\ModalidadeRepository;

class ModalidadeService 
{
    public function __construct(
        private ModalidadeRepository $modalidadeRepository
    ){}

    public function inserirModalidade($dados)
    {
        return $this->modalidadeRepository->inserirModalidade($dados);
    }

    public function deletarModalidade(int $id)
    {
        return $this->modalidadeRepository->deletarModalidade($id);
    }
}
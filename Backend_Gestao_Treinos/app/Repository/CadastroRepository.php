<?php

namespace App\Repository;

use App\Models\PessoaTreino;

class CadastroRepository
{
    public function __construct(
        private PessoaTreino $pessoaTreino
    ){}


    public function create(array $data)
    {
        return $this->pessoaTreino->create($data);
    }

    public function getById()
    {

    }

    public function getAll()
    {

    }
}
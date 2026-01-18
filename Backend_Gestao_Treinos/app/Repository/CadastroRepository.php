<?php

namespace App\Repository;

use App\Models\Usuario;

class CadastroRepository
{
    public function __construct(
        private Usuario $usuario
    ){}

    public function create(array $data)
    {
        return $this->usuario->create($data);
    }

    public function getById()
    {

    }

    public function getAll()
    {

    }
}
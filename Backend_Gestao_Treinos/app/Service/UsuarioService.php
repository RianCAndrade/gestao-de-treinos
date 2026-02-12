<?php

namespace App\Service;

use App\Repository\UsuarioRepository;

class UsuarioService 
{
    public function __construct(
        private UsuarioRepository $usuarioRepository
    ){}

    public function usuario()
    {

    }

    public function usuarioDelete($id)
    {
        $dados = $this->usuarioRepository->usuarioDeleteById($id);

        return $dados;
    }

    public function usuarioUpdate()
    {

    }
}
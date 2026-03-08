<?php

namespace App\Service;

use App\Repository\UsuarioRepository;
use Illuminate\Support\Facades\Hash;

class UsuarioService 
{
    public function __construct(
        private UsuarioRepository $usuarioRepository
    ){}

    public function usuario($id)
    {
        return $this->usuarioRepository->usuario($id);
    }

    public function usuarioDelete($id)
    {
        $dados = $this->usuarioRepository->usuarioDeleteById($id);

        return $dados;
    }

    public function usuarioUpdate($dados, int $id)
    {

        if(isset($dados['senha'])){
            $dados['senha'] = Hash::make($dados['senha']);
        }

        return $this->usuarioRepository->usuarioUpdateById($dados, $id);
    }
}
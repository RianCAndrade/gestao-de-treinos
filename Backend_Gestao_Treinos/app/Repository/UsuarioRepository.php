<?php

namespace App\Repository;

use App\Models\Usuario;

class UsuarioRepository 
{
    public function __construct(
        private Usuario $usuario
    ){}

    public function usuario()
    {

    }

    public function usuarioDeleteById($id)
    {
        return $this->usuario->findOrFail($id)->delete();
    }

    public function usuarioUpdate()
    {

    }
}
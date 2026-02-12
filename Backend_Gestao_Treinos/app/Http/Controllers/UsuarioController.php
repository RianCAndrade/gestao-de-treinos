<?php

namespace App\Http\Controllers;

use App\Service\UsuarioService;

class UsuarioController 
{
    public function __construct(
        private UsuarioService $usuarioService
    ){}

    public function usuario()
    {

    }

    public function usuarioDelete($id)
    {
        try {
            $result = $this->usuarioService->usuarioDelete($id);

            if(!$result){
                return response()->json([
                    'error' => true,
                    'message' => 'falha ao deletar ou usuario nao encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'usuario deletado com sucesso',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
        

    }

    public function usuarioUpdate()
    {

    }
}
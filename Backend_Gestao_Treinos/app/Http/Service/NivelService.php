<?php 

namespace App\Http\Service;

use App\Http\Repository\NivelRepository;

class NivelService
{
    public function __construct(
        private NivelRepository $nivelRepository
    ){}

    public function inserirNivel(array $dados)
    {
        $niveis = [];

        foreach ($dados['nivel'] as $nivel) {
            $niveis[] = [
                'nivel' => $nivel
            ];
        }

        $dados = $this->nivelRepository->inserirNivel($niveis);

        return $dados;

        // $dados = $this->nivelRepository->inserirNivel($dados);

        // return $dados;
    }

    public function deletarNivel(int $id)
    {
        return $this->nivelRepository->deletarNivel($id);
    }
}
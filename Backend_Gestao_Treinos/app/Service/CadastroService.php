<?php 

namespace App\Service;

use App\Repository\CadastroRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class CadastroService
{
    public function __construct(
        private CadastroRepository $cadastroRepository
    ){}

    public function create(array $data)
    {
        try {
            
            $data["senha"] = Hash::make($data["senha"]);

            return $this->cadastroRepository->create($data);

        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    // public function getById()
    // {

    // }

    // public function getAll()
    // {

    // }
}
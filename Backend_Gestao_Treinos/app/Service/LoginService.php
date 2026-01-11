<?php

namespace App\Service;

use App\Repository\LoginRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService 
{
    public function __construct(
        private LoginRepository $loginRepository
    ) {}

    public function authenticate(array $credenciais)
    {
        try {
            $user = $this->loginRepository->findByEmail($credenciais['email']);

            if(!$user){
                return [
                    "sucesso" => false,
                    "mensagem" => "Email ou senha incorretos"
                ];
            }

            if(!Hash::check($credenciais["senha"], $user->senha))
            {
                return [
                    "sucesso" => false,
                    "mensagem" => "senha errada tente novamente"
                ];
            }

            // if(Hash::check($credenciais["senha"], $user->senha))
            // {
            //     return 
            // }


            Auth::login($user);

            return [
                "sucesso" => true,
                "user" => $user
            ];
        } catch (ModelNotFoundException $e) {
            return [
                "sucesso" => false,
                "mensagem" => "Erro de autenticação"
            ];
        }
    }

    // public function getAll(): array
    // {
    //     return $this->loginRepository->getAll()->toArray();
    // }
}
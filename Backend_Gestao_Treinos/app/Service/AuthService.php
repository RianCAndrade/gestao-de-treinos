<?php

namespace App\Service;

use App\Repository\AuthRepository;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\Clock\now;

class AuthService 
{
    public function __construct(
        private AuthRepository $loginRepository
    ) {}

    public function authenticate(array $credenciais)
    {
        try {

           $user = $this->loginRepository->findByEmail($credenciais['email']);
            // dd($user);
            if(!$user){
                return [
                    "sucesso" => false,
                    "mensagem" => "Email ou senha incorretos"
                ];
            }


            // Verifica a senha - se no banco é "senha", use "senha"
            if(!Hash::check($credenciais["senha"], $user->senha)) {
                return [
                    "sucesso" => false,
                    "mensagem" => "Senha incorreta"
                ];
            }

            $token = $user->createToken("api-token-token")->plainTextToken;
            // dd($token);

            return [
                "sucesso" => true,
                "user" => $user,
                "token" => $token
            ];
            
        } catch (ModelNotFoundException $e) {
            return [
                "sucesso" => false,
                "mensagem" => "Erro de autenticação",
                "error" => $e->getMessage()
            ];
        }
    }

    // public function getAll(): array
    // {
    //     return $this->loginRepository->getAll()->toArray();
    // }
}
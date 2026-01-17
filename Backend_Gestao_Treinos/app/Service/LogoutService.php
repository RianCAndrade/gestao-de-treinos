<?php

namespace App\Service;

use App\Repository\LogoutRepository;
use Exception;
use Illuminate\Http\Request;

class LogoutService 
{
    public function __construct(
        private LogoutRepository $logoutRepository
    ){}

    public function logout(Request $request)
    {
        try{
            $user = $request->user();

            if (!$user){
                return [
                    "success" => false,
                    "message" => "Usuario nao autenticado"
                ];
            }


            $this->logoutRepository->logout($user);
     
     
             return [
                 "success" => true,
                 "message" => "logout realizado com sucesso"
             ];
        } catch (Exception $e){
            return [
                "error" => $e->getMessage()
            ];
        }
    }
}
<?php

namespace App\Repository;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;

class AuthRepository 
{

    public function __construct(
        private Usuario $usuario
    ){}

    // Busca por ID
    public function findByEmail(string $email): ?Model
    {
        return $this->usuario->where("email",$email)->first();
    }

    public function findById(int $id){
        return $this->usuario->find($id);
    }

    public function create(){

    }

    public function update(){
        
    }

    public function delete(){
        
    }

    public function getAll()
    {
        return $this->usuario->all();
    }   


}
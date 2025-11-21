<?php

namespace App\Repository;

use App\Models\PessoaTreino;
use Illuminate\Database\Eloquent\Model;

class LoginRepository 
{

    public function __construct(
        private PessoaTreino $pessoaTreino
    ){}

    // Busca por ID
    public function findByEmail(string $email): ?Model
    {
        return $this->pessoaTreino->where("email",$email)->first();
    }

    public function findById(int $id){
        return $this->pessoaTreino->find($id);
    }

    public function create(){

    }

    public function update(){
        
    }

    public function delete(){
        
    }

    public function getAll()
    {
        return $this->pessoaTreino->all();
    }   


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateble;
use Laravel\Sanctum\HasApiTokens;

class PessoaTreino extends Authenticateble
{
    use HasApiTokens;

    protected $table = "pessoa_treino";

    protected $fillable = [
        "nome",
        "idade",
        "email",
        "senha",
        "cpf",
    ];

    protected $hidden = [
        "senha"
    ];
}

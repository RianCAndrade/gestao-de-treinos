<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateble;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PessoaTreino extends Authenticateble
{
    use HasFactory;

    protected $table = "pessoa_treino";

    protected $fillable = [
        "nome",
        "idade",
        "email",
        "senha",
        "cpf",
    ];
}

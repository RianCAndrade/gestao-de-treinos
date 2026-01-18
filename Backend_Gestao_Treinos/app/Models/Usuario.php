<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $table = "tb_usuarios";

    protected $fillable = [
        "nome",
        "idade",
        "email",
        "senha",
        "cpf"
    ];

    protected $hidden = [
        "senha",
        "remember_token"
    ];
}
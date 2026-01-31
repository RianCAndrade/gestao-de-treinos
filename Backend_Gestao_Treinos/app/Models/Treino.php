<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    protected $table = "tb_treinos";

    protected $fillable = [
        "fk_usuario",
        "nome",
        "descricao"
    ];

    // public $timestamps = true;
}

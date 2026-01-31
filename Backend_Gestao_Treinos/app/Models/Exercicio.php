<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $table = "tb_exercicios";

    protected $fillable = [
        "titulo",
        "descricao",
        "tipo",
        "nivel",
        "video_url",
        "imagem_url",
        "ativo",
    ];
}

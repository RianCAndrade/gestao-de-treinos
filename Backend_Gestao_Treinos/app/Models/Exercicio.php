<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $table = "tb_exercicios";

    protected $fillable = [
        "titulo",
        "descricao",
        "fk_modalidade",
        "nivel",
        "video_url",
        "imagem_url",
        "ativo",
    ];


    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class, 'fk_modalidade');
    }
}

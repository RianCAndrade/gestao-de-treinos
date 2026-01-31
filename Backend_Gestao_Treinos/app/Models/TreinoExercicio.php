<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreinoExercicio extends Model
{
    protected $table = "tb_treino_exercicios";

    protected $fillable = [
        "fk_treino",
        "fk_exercicio",
        "ordem",
        "series",
        "repeticoes",
        "carga",
        "descanso_segundos",
        "observacao",
    ];
}

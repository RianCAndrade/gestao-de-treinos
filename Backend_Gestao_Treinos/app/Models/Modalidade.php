<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $table = "tb_modalidades";

    protected $fillable = [
        "nome"
    ];


    public function Exercicio()
    {
        return $this->hasOne(Exercicio::class);
    }
}

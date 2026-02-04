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
    
    protected static function booted()
    {
        static::saving(function ($model) {
            $model->titulo_search = self::normalize($model->titulo);
        });
    }

    private static function normalize(string $text): string
    {
        $text = mb_strtolower($text);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        return $text;
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class, 'fk_modalidade');
    }
}

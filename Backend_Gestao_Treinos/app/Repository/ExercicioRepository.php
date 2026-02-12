<?php

namespace App\Repository;

use App\Models\Exercicio;
use GuzzleHttp\Psr7\Query;

class ExercicioRepository 
{

    public function __construct(
        private Exercicio $exercicio
    )
    {}

    public function findAllExercicios()
    {
        return $this->exercicio::all();
    }

    public function findByModalidade($modalidade)
    {
        return $this->exercicio::where('fk_modalidade', $modalidade)->get();
    }

    public function searchExercicio(?string $search)
    {
        return $this->exercicio
            ->when($search, function ($query) use ($search) {
                $search = mb_strtolower($search);

                // $query->whereRaw('LOWER(titulo) LIKE ?', ["%{$search}%"]);
                // $query->where('titulo', 'ILIKE', "%{$search}%");
                $search = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $search);

                $query->where('titulo_search', 'like', "%{$search}%");
            })
            ->orderBy('titulo')
            ->get();
    }

    public function detalheExercicios($id)
    {
        return $this->exercicio::where('id', $id)->get();
    }

}
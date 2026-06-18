<?php

namespace Database\Seeders;

use App\Models\Modalidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadeSeeder extends Seeder
{
    public function run(): void
    {
        $modalidades = [
            'Musculacao',
            'Calistenia',
            'CrossFit',
            'Yoga',
            'Pilates'
        ];

        foreach ($modalidades as $nome){
            Modalidade::create(['nome' => $nome]);
        }
    }
}

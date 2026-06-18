<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nome' => 'Miau Nervoso',
            'idade' => 25,
            'email' => 'miau123@email.com',
            'senha' => Hash::make('miau123'),
            'cpf' => '12345678901',
            'remember_token' => Str::random(50),
        ]);
    }
}

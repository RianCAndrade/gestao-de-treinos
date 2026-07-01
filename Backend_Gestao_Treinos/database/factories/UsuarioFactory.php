<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;


class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'idade' => $this->faker->numberBetween(18, 80),
            'email' => $this->faker->unique()->safeEmail(),
            'senha' => bcrypt('senha123'),
            'cpf' => $this->faker->unique()->numerify('###########'),
        ];
    }
}
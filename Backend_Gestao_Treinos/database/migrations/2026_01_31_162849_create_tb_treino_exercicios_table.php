<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_treino_exercicios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fk_treino')
            ->constrained('tb_treinos')
            ->cascadeOnDelete();

            $table->foreignId('fk_exercicio')
            ->constrained('tb_exercicios')
            ->cascadeOnDelete();

            $table->unsignedInteger('ordem')->default(1);
            $table->unsignedInteger('series')->nullable();
            $table->unsignedInteger('repeticoes')->nullable();

            $table->decimal('carga', 6, 2)->nullable(); //kg
            $table->unsignedInteger('descanso_segundos')->nullable();
            $table->string('observacao')->nullable();

            $table->timestamps();

            // Evita duplicar mesmo exercicio no mesmo treino
            $table->unique('fk_treino', 'fk_exercicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_treino_exercicios');
    }
};

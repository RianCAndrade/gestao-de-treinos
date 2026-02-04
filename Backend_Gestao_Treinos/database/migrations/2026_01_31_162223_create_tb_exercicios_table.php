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
        Schema::create('tb_exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('titulo_search')->index();
            $table->text('descricao')->nullable();
            $table->foreignId('fk_modalidade')
            ->constrained("tb_modalidades")
            ->cascadeOnDelete();
            $table->enum('nivel',['Iniciante', 'Intermediario', 'avancado'])->nullable();
            $table->string('video_url')->nullable();
            $table->string('imagem_url')->nullable();

            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_exercicios');
    }
};

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
        Schema::create('pessoa_treino', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("idade");
            $table->string("email");
            $table->string("senha");
            $table->string("cpf");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa_treino');
    }
};

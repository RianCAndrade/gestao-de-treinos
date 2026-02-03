<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;


Route::middleware(["api"])->group(function(){
    Route::post("/login",[AuthController::class, "login"]);
    Route::post("/cadastro", [CadastroController::class, "register"]);
});


Route::middleware(["auth:sanctum"])->group(function (){
    Route::get("/conteudo", [ConteudoController::class, "conteudo"]);
    Route::post("/logout", [LogoutController::class, "logout"]);

    // Rotas exercicios
    Route::get("/exercicio", [ExercicioController::class, "getExercicios"]);
    Route::post("/exercicio/detalhe", [ExercicioController::class, "getByModalidade"]);
    // Route::get("/exercicio/{modalidade}", [ExercicioController::class, "getAllModalidades"]);
});


<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::middleware(["api"])->group(function(){
    Route::post("/login",[AuthController::class, "login"]);
    Route::post("/cadastro", [CadastroController::class, "register"]);
});


Route::middleware(["auth:sanctum"])->group(function (){
    Route::get("/home", [HomeController::class, "home"]);
    Route::post("/logout", [LogoutController::class, "logout"]);
    
    //Rotas Usuario

    // Route::get('/usuario', []);
    // Route::put('/usuario/update', []);
    Route::delete("/usuario/delete/{id}", [UsuarioController::class, "usuarioDelete"]);


    // admin
    Route::group(['prefix' => 'admin'], function () {
        // Route::
    });

    // Rotas exercicios
    Route::get("/exercicio", [ExercicioController::class, "exercicios"]);
    Route::post("/exercicio/modalidade", [ExercicioController::class, "Modalidade"]);
    Route::get("/exercicio/pesquisa", [ExercicioController::class, "searchExercicio"]);
    Route::get("/exercicio/detalhe/{id}", [ExercicioController::class, "detalheExercicio"]);
});


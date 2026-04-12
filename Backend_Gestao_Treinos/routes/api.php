<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ModalidadeController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr;

Route::middleware(["api"])->group(function(){
    Route::post("/login",[AuthController::class, "login"]);
    Route::post("/cadastro", [CadastroController::class, "register"]);
});


Route::middleware(["auth:sanctum"])->group(function (){
    Route::get("/home", [HomeController::class, "home"]);
    Route::post("/logout", [LogoutController::class, "logout"]);
    
    //Rotas Usuario
    Route::get('/usuario/{id}', [UsuarioController::class, "usuario"]); // pegar informação de um usuario
    Route::put('/usuario/update/{id}', [UsuarioController::class, "usuarioUpdate"]);
    Route::delete("/usuario/delete/{id}", [UsuarioController::class, "usuarioDelete"]); // Proprio usuario deleta sua conta

    // Rota da IA
    Route::get("/chat",[ChatController::class, 'chat']);


    // Rotas admin
    Route::group(['prefix' => '/admin'], function () {
        Route::post('/inserirexercicio', [ExercicioController::class, 'inserirExercicio']);
        Route::delete('/deletarexercicio/{id}', [ExercicioController::class, 'deletarExercicio']);
        Route::post('/inserirmodalidade', [ModalidadeController::class, 'inserirModalidade']);
        Route::delete('/deletarmodalidade/{id}', [ModalidadeController::class, 'deletarModalidade']);
        Route::post('/inserirnivel', [NivelController::class, 'inserirnivel']);
        Route::delete('/deletarnivel/{id}', [NivelController::class, 'deletarNivel']);
    });

    // Rotas exercicios
    Route::get("/exercicio", [ExercicioController::class, "exercicios"]);
    Route::post("/exercicio/modalidade", [ExercicioController::class, "Modalidade"]);
    Route::get("/exercicio/pesquisa", [ExercicioController::class, "searchExercicio"]);
    Route::get("/exercicio/detalhe/{id}", [ExercicioController::class, "detalheExercicio"]);
});


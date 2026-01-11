<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\LogoutController;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::middleware(["api"])->group(function(){
    Route::post("/login",[AuthController::class, "login"]);
    Route::post("/cadastro", [CadastroController::class, "register"]);
});


Route::middleware(["auth:sanctum", "api"])->group(function (){
    Route::get("/conteudo", [ConteudoController::class, "conteudo"]);
    Route::post("/logout", [LogoutController::class, "logout"]);
});


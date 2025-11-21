<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cad_usuarioscontroller;
use App\Http\Controllers\ConteudoController;

Route::get('/', [AuthController::class, "index"])->name("index");
Route::get("/cadastro", [Cad_usuarioscontroller::class, "create"])->name("cadastro.form");
Route::post('/cadastro', [Cad_usuarioscontroller::class, "store"])->name('cadastro.pessoaCadastro');
Route::get("/conteudo", [ConteudoController::class, "conteudo"])->name("conteudo.body");
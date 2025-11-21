<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::post("/login",[LoginController::class, "login"]);
// Route::get("/login",[LoginController::class, "index"]);
Route::post("/cadastro", [CadastroController::class, "register"]);
Route::get("/cadastro", [CadastroController::class, "register"]);


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\PessoaTreino;

class ConteudoController extends Controller
{

    public function conteudo()
    {
        return response()->json(["sucess"=> true]);
        
    }
}

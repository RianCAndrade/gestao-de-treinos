<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConteudoController extends Controller
{

    public function conteudo()
    {
        return response()->json(["sucess"=> true]);
        
    }
}

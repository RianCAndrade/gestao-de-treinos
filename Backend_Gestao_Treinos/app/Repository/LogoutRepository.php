<?php

namespace App\Repository;

use App\Models\PessoaTreino;

class LogoutRepository 
{
    public function logout(PessoaTreino $user)
    {
        $user->currentAccessToken()?->delete();
    }

    
}
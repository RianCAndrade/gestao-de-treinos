<?php

namespace App\Repository;

use App\Models\Usuario;

class LogoutRepository 
{
    public function logout(Usuario $user)
    {
        $user->currentAccessToken()?->delete();
    }

    
}
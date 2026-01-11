<?php

namespace App\Service;

use App\Repository\LogoutRepository;

class LogoutService 
{
    public function __construct(
        private LogoutRepository $logoutRepository
    ){}
}
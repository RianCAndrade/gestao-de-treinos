<?php

namespace App\Http\Controllers;

use App\Service\LogoutService;
use Symfony\Component\HttpFoundation\Request;

class LogoutController extends Controller
{
    public function __construct(
        private LogoutService $logoutService
    ){}

    public function logout(Request $request)
    {
        
    }
}
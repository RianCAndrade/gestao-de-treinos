<?php

namespace App\Http\Controllers;

use App\Service\LogoutService;
use Exception;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct(
        private LogoutService $logoutService
    ){}

    public function logout(Request $request)
    {
        try{
            $result = $this->logoutService->logout($request);
            // dd($result);
            
            return response()->json([
                "success" => $result["success"],
                "message" => $result["message"]
            ]);

        } catch (Exception $e){
            return [
                "error" => $e->getMessage()
            ];
        }
    }
}
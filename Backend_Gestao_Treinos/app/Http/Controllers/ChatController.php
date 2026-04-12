<?php

namespace App\Http\Controllers;

use App\Http\Service\ChatService;
use Illuminate\Http\Request;

class ChatController
{
    public function __construct(
        private ChatService $chatService
    ){}

    public function chat(Request $request)
    {
        try {

            $message = [
                [
                    "role" => "user",
                    "content" => $request->pergunta
                ]
            ];

            $response = $this->chatService->chat($message);

            if(!$response){
                return response()->json([
                    "error" => true,
                    "message" => "erro na requesição"
                ], 422);
            }

            return response()->json([
                "error" => false,
                "message" => $response
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "erro inesperado, " . $e->getMessage()
            ], 500);
        }
    }
}
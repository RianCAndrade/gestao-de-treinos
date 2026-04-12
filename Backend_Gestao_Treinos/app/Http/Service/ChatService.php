<?php 

namespace App\Http\Service;

use Illuminate\Support\Facades\Http;

class ChatService
{
    private $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';

    // public function __construct(

    // ){}

    public function chat($message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer' . env('OPENROUTER_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post($this->baseUrl, [
            "model" => "openrouter/free",
            "message" => $message,
            "reasoning" => ["enabled" => true]
        ]);

        $data = $response->json();

        return $data['choice'][0]['message'];
    }
}
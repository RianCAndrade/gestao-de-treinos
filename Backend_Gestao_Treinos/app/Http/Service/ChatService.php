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
        $response = Http::timeout(120)->withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post($this->baseUrl, [
            "model" => "nvidia/nemotron-3-super-120b-a12b:free",
            "messages" => $message,
            "reasoning" => ["enabled" => true]
        ]);

        $data = $response->json();

        return $data["choices"][0]["message"];
    }
}
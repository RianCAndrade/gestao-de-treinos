<?php

namespace App\Service;

use App\Ai\Agents\GymTrainer;

class ChatService
{
    public function stream(string $pergunta, ?string $conversationId = null)
    {
        $agent = new GymTrainer;

        if ($conversationId) {
            $agent = $agent->continue($conversationId, as: auth()->user());
        } else {
            $agent = $agent->forUser(auth()->user());
        }

        return $agent->stream($pergunta);
    }
}

<?php

namespace App\Ai\Agents;

use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;

#[Model('nvidia/nemotron-3-super-120b-a12b:free')]
class GymTrainer implements Agent
{
    use Promptable, RemembersConversations;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): string
    {
        return 'Você é um personal trainer especializado em calistenia e musculação. Ajude o usuário com treinos, exercícios, nutrição e dicas de fitness. Responda sempre em português do Brasil.';
    }
}

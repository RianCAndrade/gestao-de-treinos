<?php

namespace App\Http\Controllers;

use App\Service\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController
{
    public function __construct(
        private ChatService $chatService
    ) {}

    public function chat(Request $request)
    {
        $conversationId = $request->input('conversation_id');

        $stream = $this->chatService->stream(
            $request->input('pergunta'),
            $conversationId
        );

        return response()->stream(function () use ($stream, $conversationId) {
            foreach ($stream as $event) {
                echo 'data: '.((string) $event)."\n\n";

                if (ob_get_level() > 0) {
                    ob_flush();
                }
                flush();
            }

            if (! $conversationId) {
                $conversation = DB::table('agent_conversations')
                    ->where('user_id', auth()->id())
                    ->latest('updated_at')
                    ->first();

                $conversationId = $conversation?->id;
            }

            echo 'data: '.json_encode([
                'type' => 'conversation_id',
                'conversation_id' => $conversationId,
            ])."\n\n";

            echo "data: [DONE]\n\n";

            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}

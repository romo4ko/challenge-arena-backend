<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TelegramController
{
    public function syncTelegram(Request $request): JsonResponse
    {
        $request->validate([
            'telegram_id' => 'required|string',
            'telegram_username' => 'required|string',
            'secret_key' => 'required|string',
        ]);

        if ($request->secret_key !== env('TELEGRAM_SECRET_KEY')) {
            return response()->json(['message' => 'error'], 403);
        }

        $success = (bool) User::query()
            ->where('telegram_username', $request->post('telegram_username'))
            ->update([
                'telegram_id' => $request->post('telegram_id'),
            ]);

        if ($success) {
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error'], 404);
        }
    }
}

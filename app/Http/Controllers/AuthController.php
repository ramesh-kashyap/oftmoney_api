<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function telegramUser(Request $request)
{
    try {
        $validated = $request->validate([
            'telegram_id' => 'required|numeric|min:1', // 🚫 no negative
            'first_name'  => 'required|string',
            'last_name'   => 'nullable|string',
            'username'    => 'nullable|string',
            'referred_by' => 'nullable|numeric|min:1',
        ]);

        // force string (safe for bigint)
        $validated['telegram_id'] = (string) $validated['telegram_id'];
        $validated['balance'] = 0;

        if (
            !empty($validated['referred_by']) &&
            $validated['referred_by'] !== $validated['telegram_id']
        ) {
            $exists = TelegramUser::where('telegram_id', $validated['telegram_id'])->exists();

            $referrer = TelegramUser::where(
                'telegram_id',
                (string) $validated['referred_by']
            )->first();

            if ($referrer && !$exists) {
                $bonus = config('clicker.referral.base.welcome');
                if ($bonus > 0) {
                    $referrer->increment('balance', $bonus);
                    $validated['balance'] += $bonus;
                }
            }
        } else {
            $validated['referred_by'] = null;
        }

        $user = TelegramUser::firstOrCreate(
            ['telegram_id' => $validated['telegram_id']],
            $validated
        );

        $user->updateLoginStreak();

        $token = $user->createToken((string) $user->telegram_id);

        return response()->json([
            'first_login' => $user->wasRecentlyCreated,
            'token' => $token->plainTextToken,
        ]);

    } catch (\Throwable $e) {
        \Log::error('Telegram Login Error', [
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'message' => 'Telegram login failed',
        ], 500);
    }
}
    // public function tele(Request $request)
    // {
        

    //     return response()->json([
    //         'first_login' => "hllo",
    //     ]);
    // }
}

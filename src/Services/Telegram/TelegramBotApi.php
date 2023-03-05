<?php

namespace Services\Telegram;

use App\Logging\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;
use Throwable;

class TelegramBotApi implements TelegramBotApiContract
{
    public const HOST = 'https://api.telegram.org/bot';
    
    public static function fake(): TelegramBotApiFake
    {
        return app()->instance(
            TelegramBotApiContract::class,
            new TelegramBotApiFake()
        );

    }
    
    public static function sendMessage(string $token, int $chatId, string $text): bool
    {
        try {
                $response = Http::post(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chatId,
                'text' => $text,
            ])->throw()->json();
            
            return $response['ok'] ?? false;

        } catch (Throwable $e) {
            
            report(throw new TelegramBotApiException($e->getMessage()));

            return false;
        }
       

    }
}
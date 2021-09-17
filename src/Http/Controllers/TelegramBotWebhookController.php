<?php

namespace AgliPanci\TelegramBot\Http\Controllers;

use AgliPanci\TelegramBot\Facades\Telegram;
use Illuminate\Http\Request;

class TelegramBotWebhookController
{
    public function __invoke(Request $request)
    {
        Telegram::handle();
    }
}

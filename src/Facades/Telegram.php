<?php

namespace AgliPanci\TelegramBot\Facades;

use Illuminate\Support\Facades\Facade;

class Telegram extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'telegram';
    }

}

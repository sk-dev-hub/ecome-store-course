<?php

namespace App\Exceptions;

use Exception;


class TelegramException extends Exception
{
    public function report()
    {
        logger()->debug('ошибка отправки телеграм');
    }
}

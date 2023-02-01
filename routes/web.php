<?php

use App\Logging\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    
    return view('welcome');
});

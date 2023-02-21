<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CashClearCommand extends Command
{

    protected $signature = 'shop:clear';

    protected $description = 'clear cach and config';


    public function handle(): int
    {
        if(app()->isProduction()){
            return self::FAILURE;
        }
        

        $this->call('config:clear');
        $this->call('cache:clear');


        return self::SUCCESS;
    }
}

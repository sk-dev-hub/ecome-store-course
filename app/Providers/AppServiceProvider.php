<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

       //логгинг только в продакшене
       
        if (app()->isProduction()){
            // DB::whenQueryingForLongerThan(CarbonInterval::seconds(5), 
            //     function (Connection $connection) {
            //     logger()
            //         ->channel('telegram')
            //         ->debug('whenQueryingForLongerThan:' . $connection->totalQueryDuration());
            // });

            DB::listen(function ($query){

                // $query->sql;
                // $query->bindings;
                // $query->time;

                
                if($query->time > 100){

                    logger()
                    ->channel('telegram')
                    ->debug('Запрос в бд больше 1 мс:' . $query->sql, $query->bindings);
                }


            });

            $kernel = app(Kernel::class);

            $kernel->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function() {
                    logger()
                    ->channel('telegram')
                    ->debug('whenRequestLifecycleIsLongerThan:' . request()->url());
                }
            );
       };
       

    }
}

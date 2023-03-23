<?php

namespace Domain\Product\Providers;

use Illuminate\Support\ServiceProvider;

// use Illuminate\Support\Facades\Gate;

class ProductServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

    }

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}

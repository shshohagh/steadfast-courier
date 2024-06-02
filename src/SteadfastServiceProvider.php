<?php

namespace Shshohagh\SteadfastCourier;

use Illuminate\Support\ServiceProvider;

class SteadfastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/steadfast.php' => config_path('steadfast.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/steadfast.php', 'steadfast'
        );

        $this->app->singleton(Steadfast::class, function ($app) {
            return new Steadfast();
        });
    }
}

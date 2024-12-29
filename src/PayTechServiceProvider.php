<?php

namespace Mcire\PayTech;

use Illuminate\Support\ServiceProvider;

class PayTechServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/paytech.php', 'paytech');

        $this->app->singleton('paytech', function () {
            return new Services\PayTech();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/paytech.php' => config_path('paytech.php'),
        ], 'config');
    }
}

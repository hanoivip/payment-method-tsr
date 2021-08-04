<?php

namespace Hanoivip\PaymentMethodTsr;

use Illuminate\Support\ServiceProvider;

class LibServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/hanoivip'),
            __DIR__.'/../config' => config_path(),
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadTranslationsFrom( __DIR__.'/../lang', 'hanoivip');
        $this->mergeConfigFrom( __DIR__.'/../config/tsr.php', 'tsr');
    }
    
    public function register()
    {
        $this->commands([
        ]);
        $this->app->bind("TsrPaymentMethod", TsrMethod::class);
        //$this->app->bind(IHelper::class, Helper::class);
        $this->app->bind(IHelper::class, HelperTestSuccess::class);
        //$this->app->bind(IHelper::class, HelperTestDelay::class);
    }
}

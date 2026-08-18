<?php

namespace Syedmahamudul\Sslcommerz\Providers;

use Illuminate\Support\ServiceProvider;
use Syedmahamudul\Sslcommerz\Console\Commands\InstallCommand;
use Syedmahamudul\Sslcommerz\Console\Commands\MakePaymentCommand;
use Syedmahamudul\Sslcommerz\Services\SslcommerzService;

class SslcommerzServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/sslcommerz.php',
            'sslcommerz'
        );

        $this->app->singleton('sslcommerz', function ($app) {
            return new SslcommerzService(
                $app['config']->get('sslcommerz')
            );
        });
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->publishes([
            __DIR__ . '/../Config/sslcommerz.php' => config_path('sslcommerz.php'),
        ], 'sslcommerz-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                MakePaymentCommand::class,
            ]);
        }
    }
}
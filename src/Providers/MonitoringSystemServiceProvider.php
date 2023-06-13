<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Providers;

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Illuminate\Support\ServiceProvider;
use PrajapatiAakash\LaravelMonitoringSystem\Middleware\LogRequestsAndResponses;
use PrajapatiAakash\LaravelMonitoringSystem\ErrorLogger;
use Illuminate\Contracts\Debug\ExceptionHandler;
use PrajapatiAakash\LaravelMonitoringSystem\Exceptions\CustomExceptionHandler;

class MonitoringSystemServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ExceptionHandler $exceptionHandler)
    {
        $this->app['router']->aliasMiddleware('logrequestsandresponses', LogRequestsAndResponses::class);
        $this->loadRoutesFrom(__DIR__.'/../../routes/monitoring-system.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'laravel-monitoring-system');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/laravel-monitoring-system'),
        ], 'laravel-monitoring-system-views');
        $this->publishes([
            __DIR__.'/../../assets' => public_path('vendor/laravel-monitoring-system'),
        ], 'laravel-monitoring-system-assets');
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            CustomExceptionHandler::class
        );
    }
}

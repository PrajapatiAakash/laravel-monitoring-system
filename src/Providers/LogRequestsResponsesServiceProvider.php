<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Providers;

use Illuminate\Support\ServiceProvider;
use PrajapatiAakash\LaravelMonitoringSystem\Middleware\LogRequestsAndResponses;

class LogRequestsResponsesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
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
    }
}

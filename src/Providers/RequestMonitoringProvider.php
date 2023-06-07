<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Providers;

use Illuminate\Support\ServiceProvider;

class RequestMonitoringProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/monitoring-system.php');
    }
}
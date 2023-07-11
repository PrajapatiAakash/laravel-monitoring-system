<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Providers;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Illuminate\Support\ServiceProvider;
use PrajapatiAakash\LaravelMonitoringSystem\Middleware\LogRequestsAndResponses;
use PrajapatiAakash\LaravelMonitoringSystem\QueryLogger;
use Illuminate\Contracts\Debug\ExceptionHandler;
use PrajapatiAakash\LaravelMonitoringSystem\Exceptions\CustomExceptionHandler;
use Illuminate\Support\Facades\DB;
use PrajapatiAakash\LaravelMonitoringSystem\Models\QueryLog;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Events\QueryExecuted;

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
    public function boot()
    {
        $this->app['router']->aliasMiddleware('logrequestsandresponses', LogRequestsAndResponses::class);
        $this->loadRoutesFrom(__DIR__.'/../../routes/monitoring-system.php');
        $this->mergeConfigFrom(__DIR__.'/../../config/laravel-monitoring-system.php', 'laravel-monitoring-system');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/laravel-monitoring-system.php' => config_path('laravel-monitoring-system.php'),
            ], 'laravel-monitoring-system-config');
        }
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
        DB::listen(function ($query) {
            if (app()->runningInConsole() || $this->isQueryLogQuery($query)) {
                return;
            }

            $this->logQuery($query);
        });
    }

    private function isQueryLogQuery($query)
    {
        if (strpos($query->sql, 'query_logs') !== false) {
            return true;
        }

        return false;
    }

    private function logQuery(QueryExecuted $query)
    {
        $sql = $query->sql;
        $bindings = $query->bindings;
        $time = $query->time;

        // Format the query with bindings
        $formattedQuery = vsprintf(str_replace('?', '%s', $sql), $bindings);

        QueryLog::create([
            'query' => $formattedQuery,
            'time' => $time,
            'url' => request()->getRequestUri(),
            'full_url' => request()->fullUrl(),
        ]);
    }
}

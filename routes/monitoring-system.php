<?php

use Illuminate\Support\Facades\Route;
use PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers\DashboardController;

Route::group([
    'namespace' => 'PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers',
    'prefix' => 'admin/monitoring-system',
    //'middleware' => 'auth'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('monitoring-system.dashboard');
    Route::resource('request-logs', 'RequestLogController');
    Route::resource('error-logs', 'ErrorLogController');
    Route::resource('query-logs', 'QueryLogController');
});

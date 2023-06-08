<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers',
    'prefix' => 'admin/monitoring-system',
], function () {
    Route::resource('request-logs', 'RequestLogController');
});

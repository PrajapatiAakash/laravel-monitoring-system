<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'PrajapatiAakash\LaravelMonitoringSystem\Controllers',
    'prefix' => 'admin',
], function () {
    Route::get('monitoring-system', 'RequestController@index');
});

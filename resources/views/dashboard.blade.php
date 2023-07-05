<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Request Logs')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-6">
            <x-laravel-monitoring-system::line-chart id="failed-requests-chart" title="Failed Requests" :data="$requestLogs" />
        </div>
        <div class="col-6">
            <x-laravel-monitoring-system::doughnut-chart id="error-by-type-chart" title="Today Error By Type" :data="$errorLogs" />
        </div>
    </div>
@endsection

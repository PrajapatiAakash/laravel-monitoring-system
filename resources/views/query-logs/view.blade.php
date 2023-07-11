<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Request Logs')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Query Log Details</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td class="w-25">ID</td>
                    <td class="w-75">{{ $queryLog->id }}</td>
                </tr>
                <tr>
                    <td>Query</td>
                    <td>{{ $queryLog->query }}</td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td>{{ $queryLog->time }}</td>
                </tr>
                <tr>
                    <td>Url</td>
                    <td>{{ $queryLog->url }}</td>
                </tr>
                <tr>
                    <td>Full Url</td>
                    <td>{{ $queryLog->full_url }}</td>
                </tr>
                <tr>
                    <td>Created Date</td>
                    <td>{{ $queryLog->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

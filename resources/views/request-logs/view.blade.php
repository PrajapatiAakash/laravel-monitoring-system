<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Request Logs')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Request Log Details</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td class="w-25">ID</td>
                    <td class="w-75">{{ $requestLog->id }}</td>
                </tr>
                <tr>
                    <td>User ID</td>
                    <td>{{ $requestLog->user_id }}</td>
                </tr>
                <tr>
                    <td>Url</td>
                    <td>{{ $requestLog->url }}</td>
                </tr>
                <tr>
                    <td>Full Url</td>
                    <td>{{ $requestLog->full_url }}</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>{{ $requestLog->method }}</td>
                </tr>
                <tr>
                    <td>Payload</td>
                    <td>
                        <pre>{{ json_encode($requestLog->payload, JSON_PRETTY_PRINT) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td>Ip Address</td>
                    <td>{{ $requestLog->ip_address }}</td>
                </tr>
                <tr>
                    <td>User Agent</td>
                    <td>{{ $requestLog->user_agent }}</td>
                </tr>
                <tr>
                    <td>Status Code</td>
                    <td>{{ $requestLog->status_code }}</td>
                </tr>
                <tr>
                    <td>Response Content</td>
                    <td>
                        {{ $requestLog->response_content }}
                    </td>
                </tr>
                <tr>
                    <td>Created Date</td>
                    <td>{{ $requestLog->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

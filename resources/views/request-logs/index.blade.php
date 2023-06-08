<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Request Logs')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Request Logs</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Url</th>
                    <th scope="col">Method</th>
                    <th scope="col">Ip Addres</th>
                    <th scope="col">Status Code</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requestLogs as $requestLog)
                    <tr>
                        <td>{{ $requestLog->id }}</td>
                        <td>{{ $requestLog->url }}</td>
                        <td>{{ $requestLog->method }}</td>
                        <td>{{ $requestLog->ip_address }}</td>
                        <td>{{ $requestLog->status_code }}</td>
                        <td>{{ $requestLog->created_at }}</td>
                        <td>
                            <a href="{{ route('request-logs.show', $requestLog->id) }}" class="btn btn-primary">View</a>
                            <button class="btn btn-danger" onclick="deleteRecord({{ $requestLog->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $requestLogs->links() }}
    </div>
@endsection

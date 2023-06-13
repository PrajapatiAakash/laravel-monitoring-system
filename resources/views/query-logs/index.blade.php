<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Query Logs')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
        <h1 class="h2">Query Logs</h1>
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
                    <th scope="col">Query</th>
                    <th scope="col">Time</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($queryLogs as $queryLog)
                    <tr>
                        <td>{{ $queryLog->id }}</td>
                        <td>{{ $queryLog->query }}</td>
                        <td>{{ $queryLog->time }}</td>
                        <td>{{ $queryLog->created_at }}</td>
                        <td>
                            <a href="{{ route('query-logs.show', $queryLog->id) }}" class="btn btn-primary">View</a>
                            <button class="btn btn-danger" onclick="deleteRecord({{ $queryLog->id }})">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Record(s) found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $queryLogs->links() }}
    </div>
@endsection

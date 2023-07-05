<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Error Logs')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
        <h1 class="h2">Error Logs</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Log Level</th>
                    <th scope="col">Message</th>
                    <th scope="col">Code</th>
                    <th scope="col">File Name</th>
                    <th scope="col">Line Number</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($errorLogs as $errorLog)
                    <tr>
                        <td>{{ $errorLog->id }}</td>
                        <td>{{ $errorLog->log_level }}</td>
                        <td>{{ $errorLog->message }}</td>
                        <td>{{ $errorLog->code }}</td>
                        <td>{{ $errorLog->file }}</td>
                        <td>{{ $errorLog->line }}</td>
                        <td>{{ $errorLog->created_at }}</td>
                        <td>
                            <a href="{{ route('error-logs.show', $errorLog->id) }}" class="btn btn-primary">View</a>
                            <button class="btn btn-danger" onclick="deleteRecord({{ $errorLog->id }})">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Record(s) found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $errorLogs->links() }}
    </div>
@endsection

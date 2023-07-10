<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Query Logs')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
        <h1 class="h2">Query Logs</h1>
    </div>
    <x-laravel-monitoring-system::success-flash-message title="Query Log has been deleted successfully." />
    <form id="searchForm" action="{{ route('query-logs.index') }}" method="GET" class="flex items-center">
        <div class="row">
            <div class="col-6" style="padding-right: 2px;">
            <div class="mb-3">
                <input type="text" class="form-control"
                    name="search"
                    placeholder="Search by id, and query"
                    value="{{ request()->query('search') }}"
                >
            </div>
            </div>
            <div class="col-2" style="padding-left: 0px;">
                <div class="mb-3">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
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
                        <td>
                            <div class="td-limited-content" style="width: 700px;">
                                {{ $queryLog->query }}
                            </div>
                            <a class="view-more" href="#">View More</a>
                        </td>
                        <td>{{ $queryLog->time }}</td>
                        <td>{{ $queryLog->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('query-logs.show', $queryLog->id) }}" class="btn btn-primary me-2">View</a>
                                <form action="{{ route('query-logs.destroy', $queryLog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this query log?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="deleteRecord({{ $queryLog->id }})">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Record(s) found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $queryLogs->links('laravel-monitoring-system::pagination.bootstrap-5') }}
    </div>
@endsection

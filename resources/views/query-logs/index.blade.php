<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Query Logs')

@section('content')
    <form id="searchForm" action="{{ route('query-logs.index') }}" method="GET" class="flex items-center">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        >
            <h1 class="h2">Query Logs</h1>
            <div class="d-flex justify-content-end" style="width: 300px;">
                <input
                    type="text"
                    class="form-control"
                    id="daterange"
                    name="daterange"
                    placeholder="Select date range for filter data"
                    value="{{ request()->query('daterange') }}"
                />
            </div>
        </div>
        <x-laravel-monitoring-system::success-flash-message title="Query Log has been deleted successfully." />
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="text" class="form-control"
                        name="search"
                        placeholder="Search query logs by id, or query"
                        value="{{ request()->query('search') }}"
                    >
                    <button class="btn btn-primary ms-1">Search</button>
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
        {{ $queryLogs->appends([
            'search' => request()->query('search'),
            'daterange' => request()->query('daterange'),
        ])->links('laravel-monitoring-system::pagination.bootstrap-5') }}
    </div>
@endsection

<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Error Logs')

@section('content')
    <form id="searchForm" action="{{ route('error-logs.index') }}" method="GET" class="flex items-center">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        >
            <h1 class="h2">Error Logs</h1>
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
        <x-laravel-monitoring-system::success-flash-message title="Error Log has been deleted successfully." />
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="text" class="form-control"
                        name="search"
                        placeholder="Search by id, message, and file name"
                        value="{{ request()->query('search') }}"
                    >
                    <button class="btn btn-primary ms-1">Search</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    @php
                        $options = [
                            'warning' => 'Warning',
                            'error' => 'Error',
                            'info' => 'Info',
                        ];
                    @endphp
                    <select class="form-select form-control select2"
                        multiple=true id="select2Dropdown" placeholder="Select Log Level(s)"
                        name="log_level[]"
                    >
                        <option></option>
                        @foreach ($options as $value => $label)
                            <option value="{{ $value }}" @if (in_array($value, $logLevel)) selected @endif>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary ms-1" style="width: 150px" id="applyFilterBtn">Apply Filter</button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">User Id</th>
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
                        <td>{{ $errorLog->user_id }}</td>
                        <td>{{ $errorLog->log_level }}</td>
                        <td>
                            <div class="td-limited-content">
                                {{ $errorLog->message }}
                            </div>
                            <a class="view-more" href="javascript:void(0);">View More</a>
                        </td>
                        <td>{{ $errorLog->code }}</td>
                        <td>
                            <div class="td-limited-content">
                                {{ $errorLog->file }}
                            </div>
                            <a class="view-more" href="#">View More</a>
                        </td>
                        <td>{{ $errorLog->line }}</td>
                        <td>{{ $errorLog->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('error-logs.show', $errorLog->id) }}" class="btn btn-primary me-2">View</a>
                                <form action="{{ route('error-logs.destroy', $errorLog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this error log?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="deleteRecord({{ $errorLog->id }})">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Record(s) found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $errorLogs->appends([
            'search' => request()->query('search'),
            'log_level' => request()->query('log_level'),
            'daterange' => request()->query('daterange'),
        ])->links('laravel-monitoring-system::pagination.bootstrap-5') }}
    </div>
@endsection

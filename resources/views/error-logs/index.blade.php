<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Error Logs')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
        <h1 class="h2">Error Logs</h1>
    </div>
    <form id="searchForm" action="{{ route('error-logs.index') }}" method="GET" class="flex items-center">
        <div class="row">
            <div class="col-6" style="padding-right: 2px;">
            <div class="mb-3">
                <input type="text" class="form-control"
                    name="search"
                    placeholder="Search by id, message, and file name"
                    value="{{ request()->query('search') }}"
                >
            </div>
            </div>
            <div class="col-2" style="padding-left: 0px;">
                <div class="mb-3">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="col-2" style="padding-right: 2px;">
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
            </div>
            <div class="col-auto" style="padding-left: 0px;">
                <button class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
            </div>
        </div>
    </form>
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
        {{ $errorLogs->links('laravel-monitoring-system::pagination.bootstrap-5') }}
    </div>
@endsection

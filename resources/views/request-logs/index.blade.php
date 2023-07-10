<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Request Logs')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Request Logs</h1>
    </div>
    <form id="searchForm" action="{{ route('request-logs.index') }}" method="GET" class="flex items-center">
        <div class="row">
            <div class="col-6" style="padding-right: 2px;">
            <div class="mb-3">
                <input type="text" class="form-control"
                    name="search"
                    placeholder="Search by id, url, method, and ip address"
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
                        '200' => '200',
                        '404' => '404',
                        '500' => '500',
                    ];
                @endphp
                <select class="form-select form-control select2"
                    multiple=true id="select2Dropdown" placeholder="Select Log Level(s)"
                    name="status_code[]"
                >
                    <option></option>
                    @foreach ($options as $value => $label)
                        <option value="{{ $value }}" @if (in_array($value, $statusCode)) selected @endif>{{ $label }}</option>
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
                    <th scope="col">Url</th>
                    <th scope="col">Method</th>
                    <th scope="col">Ip Addres</th>
                    <th scope="col">Status Code</th>
                    <th scope="col">Response Time</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requestLogs as $requestLog)
                    <tr>
                        <td>{{ $requestLog->id }}</td>
                        <td>{{ $requestLog->url }}</td>
                        <td>{{ $requestLog->method }}</td>
                        <td>{{ $requestLog->ip_address }}</td>
                        <td>{{ $requestLog->status_code }}</td>
                        <td>{{ $requestLog->response_time . 'ms' }}</td>
                        <td>{{ $requestLog->created_at }}</td>
                        <td>
                            <a href="{{ route('request-logs.show', $requestLog->id) }}" class="btn btn-primary">View</a>
                            <button class="btn btn-danger" onclick="deleteRecord({{ $requestLog->id }})">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Record(s) found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $requestLogs->links('laravel-monitoring-system::pagination.bootstrap-5') }}
    </div>
@endsection

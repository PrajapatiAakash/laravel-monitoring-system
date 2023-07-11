<!-- home.blade.php -->
@extends('laravel-monitoring-system::layout')

@section('title', 'Request Logs')

@section('content')
    <form id="searchForm" action="{{ route('request-logs.index') }}" method="GET" class="flex items-center">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        >
            <h1 class="h2">Request Logs</h1>
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
        <x-laravel-monitoring-system::success-flash-message title="Request Log has been deleted successfully." />
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="text" class="form-control"
                        name="search"
                        placeholder="Search by id, url, method, and ip address"
                        value="{{ request()->query('search') }}"
                    >
                    <button class="btn btn-primary ms-1">Search</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
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
                        <td>{{ $requestLog->user_id }}</td>
                        <td>{{ $requestLog->url }}</td>
                        <td>{{ $requestLog->method }}</td>
                        <td>{{ $requestLog->ip_address }}</td>
                        <td>{{ $requestLog->status_code }}</td>
                        <td>{{ $requestLog->response_time . 'ms' }}</td>
                        <td>{{ $requestLog->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('request-logs.show', $requestLog->id) }}" class="btn btn-primary me-2">View</a>
                                <form action="{{ route('request-logs.destroy', $requestLog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request log?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="deleteRecord({{ $requestLog->id }})">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Record(s) found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $requestLogs->appends([
            'search' => request()->query('search'),
            'status_code' => request()->query('status_code'),
            'daterange' => request()->query('daterange'),
        ])->links('laravel-monitoring-system::pagination.bootstrap-5') }}
    </div>
@endsection

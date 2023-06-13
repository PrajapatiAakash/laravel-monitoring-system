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
                    <td class="w-75">{{ $errorLog->id }}</td>
                </tr>
                <tr>
                    <td>Log Level</td>
                    <td>{{ $errorLog->log_level }}</td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td>{{ $errorLog->message }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>{{ $errorLog->code }}</td>
                </tr>
                <tr>
                    <td>File Name</td>
                    <td>{{ $errorLog->file }}</td>
                </tr>
                <tr>
                    <td>Line Number</td>
                    <td>{{ $errorLog->line }}</td>
                </tr>
                <tr>
                    <td>Track</td>
                    <td>
                        {{ $errorLog->trace }}
                    </td>
                </tr>
                <tr>
                    <td>Track As String</td>
                    <td>
                        {{ $errorLog->trace_as_string }}
                    </td>
                </tr>
                <tr>
                    <td>Created Date</td>
                    <td>{{ $errorLog->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

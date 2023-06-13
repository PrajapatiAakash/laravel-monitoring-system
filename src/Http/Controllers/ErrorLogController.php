<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrajapatiAakash\LaravelMonitoringSystem\Models\ErrorLog;

class ErrorLogController extends Controller
{
    /**
     * This function is used for list the request logs
     * @param Request $request
     */
    public function index(Request $request)
    {
        $errorLogs = ErrorLog::orderBy('id', 'desc')->paginate(10); // Retrieve 10 records per page

        return view('laravel-monitoring-system::error-logs.index', ['errorLogs' => $errorLogs]);
    }

    /**
     * This function is used for show the request log
     * @param int $requestLog
     */
    public function show($id)
    {
        $errorLog = ErrorLog::find($id);

        return view('laravel-monitoring-system::error-logs.view', ['errorLog' => $errorLog]);
    }
}

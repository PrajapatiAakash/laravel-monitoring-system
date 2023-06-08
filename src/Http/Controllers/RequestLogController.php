<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrajapatiAakash\LaravelMonitoringSystem\Models\RequestLog;

class RequestLogController extends Controller
{
    /**
     * This function is used for list the request logs
     * @param Request $request
     */
    public function index(Request $request)
    {
        $requestLogs = RequestLog::orderBy('id', 'desc')->paginate(10); // Retrieve 10 records per page

        return view('laravel-monitoring-system::request-logs.index', ['requestLogs' => $requestLogs]);
    }

    /**
     * This function is used for show the request log
     * @param int $requestLog
     */
    public function show($id)
    {
        $requestLog = RequestLog::find($id);

        return view('laravel-monitoring-system::request-logs.view', ['requestLog' => $requestLog]);
    }
}

<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrajapatiAakash\LaravelMonitoringSystem\Models\QueryLog;

class QueryLogController extends Controller
{
    /**
     * This function is used for list the request logs
     * @param Request $request
     */
    public function index(Request $request)
    {
        $queryLogs = QueryLog::orderBy('id', 'desc')->paginate(10); // Retrieve 10 records per page

        return view('laravel-monitoring-system::query-logs.index', ['queryLogs' => $queryLogs]);
    }

    /**
     * This function is used for show the request log
     * @param int $requestLog
     */
    public function show($id)
    {
        $queryLog = QueryLog::find($id);

        return view('laravel-monitoring-system::query-logs.view', ['queryLog' => $queryLog]);
    }
}

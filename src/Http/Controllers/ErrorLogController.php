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
        $errorLogs = ErrorLog::orderBy('id', 'desc');

        $search = $request->input('search');
        if ($search) {
            $errorLogs = $errorLogs->where('id', 'like', '%' . $search . '%')
                ->orWhere('message', 'like', '%' . $search . '%')
                ->orWhere('file', 'like', '%' . $search . '%');
        }
        $logLevel = [
            'error',
            'warning',
            'info',
        ];
        if ($request->has('log_level')) {
            $logLevel = $request->input('log_level');
        }
        if ($logLevel) {
            $errorLogs = $errorLogs->whereIn('log_level', $logLevel);
        }
        $errorLogs = $errorLogs->paginate(10);

        return view('laravel-monitoring-system::error-logs.index', [
            'errorLogs' => $errorLogs,
            'logLevel' => $logLevel,
        ]);
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

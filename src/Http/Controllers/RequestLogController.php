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
        $requestLogs = RequestLog::orderBy('id', 'desc');

        $search = $request->input('search');
        if ($search) {
            $requestLogs = $requestLogs->where('id', 'like', '%' . $search . '%')
                ->orWhere('url', 'like', '%' . $search . '%')
                ->orWhere('method', 'like', '%' . $search . '%')
                ->orWhere('ip_address', 'like', '%' . $search . '%');
        }
        $statusCode = [
            '200',
            '404',
            '500',
        ];
        if ($request->has('status_code')) {
            $statusCode = $request->input('status_code');
        }
        if ($statusCode) {
            $requestLogs = $requestLogs->whereIn('status_code', $statusCode);
        }
        $requestLogs = $requestLogs->paginate(10);

        return view('laravel-monitoring-system::request-logs.index', [
            'requestLogs' => $requestLogs,
            'statusCode' => $statusCode,
        ]);
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

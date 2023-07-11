<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrajapatiAakash\LaravelMonitoringSystem\Models\ErrorLog;
use Carbon\Carbon;

class ErrorLogController extends Controller
{
    /**
     * This function is used for list the request logs
     * @param Request $request
     */
    public function index(Request $request)
    {
        $errorLogs = ErrorLog::orderBy('id', 'desc');

        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $errorLogs = $errorLogs->where(function ($query) use ($search) {
                $query->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('message', 'like', '%' . $search . '%')
                    ->orWhere('file', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('daterange') && $request->input('daterange')) {
            $daterange = $request->input('daterange');
            $startDate = Carbon::parse(explode(' - ', $daterange)[0])->startOfDay();
            $endDate = Carbon::parse(explode(' - ', $daterange)[1])->endOfDay();
            $errorLogs = $errorLogs->whereBetween('created_at', [$startDate, $endDate]);
        }

        $logLevel = [
            'error',
            'warning',
            'info',
        ];
        if ($request->has('log_level')) {
            $logLevel = $request->input('log_level');
            $errorLogs = $errorLogs->whereIn('log_level', $logLevel);
        }

        $errorLogs = $errorLogs->paginate(config('laravel-monitoring-system.pagination_limit'));

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

    /**
     * This function is used for destroy the errorLog
     */
    public function destroy(ErrorLog $errorLog)
    {
        $errorLog->delete();

        return redirect()->route('error-logs.index', ['is_deleted' => true]);
    }
}

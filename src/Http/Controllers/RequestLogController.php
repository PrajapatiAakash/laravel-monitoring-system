<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrajapatiAakash\LaravelMonitoringSystem\Models\RequestLog;
use Carbon\Carbon;

class RequestLogController extends Controller
{
    /**
     * This function is used for list the request logs
     * @param Request $request
     */
    public function index(Request $request)
    {
        $requestLogs = RequestLog::orderBy('id', 'desc');

        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $requestLogs = $requestLogs->where(function ($query) use ($search) {
                $query->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('method', 'like', '%' . $search . '%')
                    ->orWhere('ip_address', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('daterange') && $request->input('daterange')) {
            $daterange = $request->input('daterange');
            $startDate = Carbon::parse(explode(' - ', $daterange)[0])->startOfDay();
            $endDate = Carbon::parse(explode(' - ', $daterange)[1])->endOfDay();
            $requestLogs = $requestLogs->whereBetween('created_at', [$startDate, $endDate]);
        }

        $statusCode = [
            '200',
            '404',
            '500',
        ];
        if ($request->has('status_code')) {
            $statusCode = $request->input('status_code');
            $requestLogs = $requestLogs->whereIn('status_code', $statusCode);
        }

        $requestLogs = $requestLogs->paginate(config('laravel-monitoring-system.pagination_limit'));

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

    /**
     * This function is used for destroy the requestLog
     */
    public function destroy(RequestLog $requestLog)
    {
        $requestLog->delete();

        return redirect()->route('request-logs.index', ['is_deleted' => true]);
    }
}

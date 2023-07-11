<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PrajapatiAakash\LaravelMonitoringSystem\Models\QueryLog;
use Carbon\Carbon;

class QueryLogController extends Controller
{
    /**
     * This function is used for list the request logs
     * @param Request $request
     */
    public function index(Request $request)
    {
        $queryLogs = QueryLog::orderBy('id', 'desc');

        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $queryLogs = $queryLogs->where(function ($query) use ($search) {
                $query->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('query', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('daterange') && $request->input('daterange')) {
            $daterange = $request->input('daterange');
            $startDate = Carbon::parse(explode(' - ', $daterange)[0])->startOfDay();
            $endDate = Carbon::parse(explode(' - ', $daterange)[1])->endOfDay();
            $queryLogs = $queryLogs->whereBetween('created_at', [$startDate, $endDate]);
        }

        $queryLogs = $queryLogs->paginate(config('laravel-monitoring-system.pagination_limit'));

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

    /**
     * This function is used for destroy the queryLog
     */
    public function destroy(QueryLog $queryLog)
    {
        $queryLog->delete();

        return redirect()->route('query-logs.index', ['is_deleted' => true]);
    }
}

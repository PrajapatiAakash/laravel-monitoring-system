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
        $queryLogs = QueryLog::orderBy('id', 'desc');

        $search = $request->input('search');
        if ($search) {
            $queryLogs = $queryLogs->where('id', 'like', '%' . $search . '%')
                ->orWhere('query', 'like', '%' . $search . '%');
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

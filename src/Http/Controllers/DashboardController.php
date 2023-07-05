<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $requestLogs = DB::table('request_logs')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as count'))
            ->whereRaw('FORMAT(created_at, \'yyyy-MM\') = ?', [
                Carbon::now()->format('Y-m')
            ])
            ->where('status_code', 500)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();

        $errorLogs = DB::table('error_logs')
            ->select(DB::raw('UPPER(LEFT(log_level, 1)) + LOWER(SUBSTRING(log_level, 2, LEN(log_level) - 1)) as log_level'), DB::raw('COUNT(*) as count'))
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->groupBy('log_level')
            ->get();

        return view('laravel-monitoring-system::dashboard', ['requestLogs' => $requestLogs, 'errorLogs' => $errorLogs]);
    }
}

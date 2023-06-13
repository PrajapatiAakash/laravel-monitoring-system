<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PrajapatiAakash\LaravelMonitoringSystem\StoreRequestLog;

class LogRequestsAndResponses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        StoreRequestLog::saveRequestLog($request, $response);


        return $response;
    }
}

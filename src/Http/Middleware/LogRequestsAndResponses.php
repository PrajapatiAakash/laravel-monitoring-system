<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PrajapatiAakash\LaravelMonitoringSystem\Models\RequestLog;

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

        RequestLog::create([
            'user_id' => 0,
            'url' => $request->path(),
            'full_url' => $request->fullUrl(),
            'method' => $request->getMethod(),
            'payload' => json_encode($request->all()),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status_code' => $response->getStatusCode(),
            'response_content' => $response->getContent(),
        ]);

        return $response;
    }
}

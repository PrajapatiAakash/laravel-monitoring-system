<?php

namespace PrajapatiAakash\LaravelMonitoringSystem;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PrajapatiAakash\LaravelMonitoringSystem\Models\RequestLog;

class StoreRequestLog
{
    public static function calculateResponseTime(Request $request)
    {
        $startTime = $request->server->get('REQUEST_TIME_FLOAT');
        $endTime = microtime(true);
        $responseTime = round(($endTime - $startTime) * 1000, 2); // Calculate response time in milliseconds

        return $responseTime;
    }

    public static function saveRequestLog(Request $request, Response $response = null)
    {
        $userId = 0;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        }

        return RequestLog::create([
            'user_id' => $userId,
            'url' => $request->getRequestUri(),
            'full_url' => $request->fullUrl(),
            'method' => $request->getMethod(),
            'payload' => json_encode($request->all()),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status_code' => $response ? $response->getStatusCode() : '500',
            'response_content' => $response ? $response->getContent() : '',
            'response_time' => StoreRequestLog::calculateResponseTime($request),
        ]);
    }
}

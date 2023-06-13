<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Psr\Log\LogLevel;
use PrajapatiAakash\LaravelMonitoringSystem\Models\ErrorLog;
use PrajapatiAakash\LaravelMonitoringSystem\StoreRequestLog;

class CustomExceptionHandler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        $requestLog = StoreRequestLog::saveRequestLog(request(), null);

        ErrorLog::create([
            'request_log_id' => $requestLog->id,
            'user_id' => $requestLog->user_id,
            'log_level' => $this->getLogLevel($exception),
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => json_encode($exception->getTrace()),
            'trace_as_string' => $exception->getTraceAsString(),
        ]);

        parent::report($exception);
    }

    protected function getLogLevel(Throwable $exception): string
    {
        // Map different exception types to their corresponding log levels
        $logLevelMap = [
            \InvalidArgumentException::class => LogLevel::INFO,
            \RuntimeException::class => LogLevel::WARNING,
            \Illuminate\Database\QueryException::class => LogLevel::ERROR,
            // Add more mappings as needed
        ];

        // Check if the exception type is defined in the log level map
        foreach ($logLevelMap as $exceptionType => $logLevel) {
            if ($exception instanceof $exceptionType) {
                return $logLevel;
            }
        }

        // Return a default log level if no match found
        return LogLevel::ERROR;
    }
}

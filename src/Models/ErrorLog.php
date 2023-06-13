<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_log_id',
        'user_id',
        'message',
        'code',
        'file',
        'line',
        'trace',
        'trace_as_string',
        'log_level',
    ];
}

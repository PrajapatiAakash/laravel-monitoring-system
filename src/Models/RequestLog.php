<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'url',
        'full_url',
        'method',
        'payload',
        'ip_address',
        'user_agent',
        'status_code',
        'response_content',
    ];
}

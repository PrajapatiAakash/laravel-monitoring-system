<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'query',
        'time',
    ];
}

<?php

namespace PrajapatiAakash\LaravelMonitoringSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the URL
        $url = $request->url();

        // Retrieve the HTTP method
        $method = $request->method();

        // Retrieve the request payload
        $payload = $request->all(); // Retrieves all input data as an array

        // Retrieve the user agent
        $userAgent = $request->userAgent();

        // Retrieve the remote address
        $remoteAddress = $request->ip();

        dd($request->ip());
    }
}

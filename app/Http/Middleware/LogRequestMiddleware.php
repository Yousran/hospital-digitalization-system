<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Data dasar log
        $logData = [
            'timestamp' => now()->toDateTimeString(),
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'user_agent' => $request->userAgent(),
            'user_id' => optional($request->user())->name,
            'payload' => $request->except(['password', 'password_confirmation']),
        ];

        // Pisahkan berdasarkan metode HTTP
        switch ($request->method()) {
            case 'GET':
                Log::info('GET Request', $logData);
                break;

            case 'POST':
                Log::info('POST Request', $logData);
                break;

            case 'PUT':
                Log::info('PUT Request', $logData);
                break;

            case 'DELETE':
                Log::info('DELETE Request', $logData);
                break;

            default:
                Log::info('Other Request', $logData);
                break;
        }

        return $next($request);
    }
}

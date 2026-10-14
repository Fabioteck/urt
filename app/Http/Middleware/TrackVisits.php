<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\View;

class TrackVisits
{
    public function handle(Request $request, Closure $next)
    {
        // Don't track admin routes or telemetry ping itself
        if (!$request->is('admin*') && !$request->is('telemetry/ping')) {
            $visit = Visit::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'url' => $request->fullUrl(),
                'session_id' => session()->getId(),
                'seconds_spent' => 0,
            ]);

            View::share('activeVisitId', $visit->id);
        }

        return $next($request);
    }
}

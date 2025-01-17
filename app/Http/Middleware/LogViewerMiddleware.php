<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogViewerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return to_route('login');
        }

        if (Auth::check() && Auth::user()->rank < permission('min_rank_to_view_logs')) {
            return to_route('me.show');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->user()->role->level == 1)
            return $next($request);
        auth()->logout();
        return response()->redirectToRoute('login')->with('error', 'You are not authorized to access this section.');
    }
}

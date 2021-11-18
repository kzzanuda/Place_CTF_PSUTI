<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TaskTimeLimits
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        date_default_timezone_set('Europe/Moscow');

        $current_time = now()->addHour();
        $start = '2021-11-24 16:00:00';
        $end = '2021-11-26 19:30:00';

        $date = date_create($start); #2012-01-26T13:51:50.417-07:00

        if (Route::current()->uri === 'task/list' or ($current_time > $start and $current_time < $end) or Auth::user()->role == 'admin' or Auth::user()->role == 'juri') {
            return $next($request);
        } else {
            return response()->view('olimp.nottime', ['time'=>date_format($date, 'c')]);
        }
    }
}

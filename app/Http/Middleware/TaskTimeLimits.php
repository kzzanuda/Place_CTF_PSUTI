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
        date_default_timezone_set('Europe/Samara');

        $current_time = now();
        $start = '2021-11-25 10:00:01';
        $end = '2021-11-25 16:01:00';

        $date = date_create($start); #2012-01-26T13:51:50.417-07:00

        if (Route::current()->uri === 'task/list'
            or ($current_time > $start and $current_time < $end)
            or Auth::user()->role == 'admin'
            or Auth::user()->role == 'juri'
            or Auth::user()->email == 'test_user@psuti.ru') {
            return $next($request);
        } else if($current_time < $start) {
            return response()->view('olimp.nottime', ['time'=>date_format($date, 'c')]);
        } else {
            return response()->view('olimp.final');
        }
    }
}

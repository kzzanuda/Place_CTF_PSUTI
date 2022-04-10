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
        $start = '2022-04-13 10:00:00';
        $end = '2022-04-13 16:01:00';

        $date = date_create($start); #2012-01-26T13:51:50.417-07:00

        if (Route::current()->uri === 'task/list' or ($current_time > $start and $current_time < $end)
            or Auth::user()->role == 'admin'
            or Auth::user()->role == 'juri'
            or Auth::user()->name == 'Test') {
            return $next($request);
          } else if($current_time < $start) {
              return response()->view('ctf.nottime', ['time'=>date_format($date, 'c')]);
          } else {
              return response()->view('ctf.final');
          }
    }
}

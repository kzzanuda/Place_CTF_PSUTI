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

        $current_time = now()->addHour();
<<<<<<< HEAD
        $start = '2021-11-20 10:00:00';
        $end = '2021-11-25 16:01:00';
=======
        $start = '2021-12-02 10:00:00';
        $end = '2021-12-03 16:01:00';
>>>>>>> parent of 883f9c5 (Перенес функционал файлов из олимпиады.)

        $date = date_create($start); #2012-01-26T13:51:50.417-07:00

        if (Route::current()->uri === 'task/list' or ($current_time > $start and $current_time < $end) or Auth::user()->role == 'admin' or Auth::user()->role == 'juri') {
            return $next($request);
        } else {
            return response()->view('ctf.nottime', ['time'=>date_format($date, 'c')]);
        }
    }
}

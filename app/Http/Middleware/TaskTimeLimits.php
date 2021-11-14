<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        $current_time = now('Europe/Moscow')->addHour();
        $start = '2021-11-10 10:00:00';
        $end = '2021-11-16 12:30:00';

        if (Route::current()->uri === 'task/list' or ($current_time > $start and $current_time < $end)) {
            return $next($request);
        } else {
            return redirect(route('tasks.list'));
        }
    }
}

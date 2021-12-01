<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->active == 1){
            if (Auth::user()) {
                return $next($request);
            } else {
                session(['message'=>'Авторизуйтесь чтобы продолжить', 'back_route' => $request->route()->getName()]);
                return redirect(route('login'));
            }
        } else {
            return redirect(route('home'))->with('block', 'Вы заблокированы');
        }
    }
}

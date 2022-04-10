<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScoreboardController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Europe/Samara');

        if (time() > strtotime('2022-04-15 10:59:00')
            or Auth::user()->role == 'admin'
            or Auth::user()->role == 'juri'
            or Auth::user()->name == 'Admin') {
            return view('olimp.scoreboard')
                ->with('users', User::where('role', 'user')
                    ->get()
                    ->sortByDesc(function ($users) {
                        return $users->points();
                    }));
        } else {
            return view('olimp.nottimescore');
        }
    }
}

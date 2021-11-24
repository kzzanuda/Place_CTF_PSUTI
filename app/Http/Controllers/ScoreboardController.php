<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScoreboardController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Europe/Samara');

        if (time() > strtotime('2021-11-25 23:59:00')
            or Auth::user()->role == 'admin'
            or Auth::user()->role == 'juri') {
            return view('olimp.scoreboard')->with('users', User::where('active', 1));
        } else {
            return view('olimp.nottimescore');
        }
    }
}

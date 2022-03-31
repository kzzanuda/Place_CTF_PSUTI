<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterStatsController extends Controller
{
    public function registerByDate()
    {
        return User::where('role', 'user')->orderBy('created_at')->orderBy('city')->get();
    }
}

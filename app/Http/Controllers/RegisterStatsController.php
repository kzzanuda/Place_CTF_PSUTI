<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterStatsController extends Controller
{
    public function registerByDate()
    {
        $users = User::where('role', 'user')->where('email_verified_at', 'NOT NULL')->orderBy('created_at')->get();
        return view('admin.users', ['users' => $users]);
    }
}

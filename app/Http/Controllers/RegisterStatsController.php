<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterStatsController extends Controller
{
    public function registerByDate()
    {
        $users = User::where('role', 'user')->orderBy('created_at')->get();
        $regs = User::select(
                            DB::raw("(count(id)) as today_user"),
                            DB::raw("(DATE_FORMAT(created_at, '%d.%m.%Y')) as reg_date")
                            )
                            ->where('role', 'user')
                            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                            ->get();
        return view('admin.users', ['users' => $users, 'regs' => $regs]);
    }
}

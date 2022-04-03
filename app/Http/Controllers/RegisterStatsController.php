<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterStatsController extends Controller
{
    public function registerByDate()
    {
        $users = User::where('role', 'user')->whereNotNull('email_verified_at')->orderBy('created_at')->get();
        #$count_day = User::where('role', 'user')->whereNotNull('email_verified_at')->groupBy(DB::raw("DATE_FORMAT(email_verified_at, '%d-%m-%Y')"))->count();
        #$count_all = User::where('role', 'user')->whereNotNull('email_verified_at')->get()->count();
        $regs = User::select(
                            DB::raw("(count(id)) as today_user"),
                            DB::raw("(DATE_FORMAT(email_verified_at, '%d.%m.%Y')) as reg_date")
                            )
                            ->orderBy('email_verified_at')
                            ->groupBy(DB::raw("DATE_FORMAT(email_verified_at, '%d-%m-%Y')"))
                            ->get();
        return view('admin.users', ['users' => $users, 'regs' => $regs]);#'count_all' => $count_all, 'count_day' => $count_day]);
    }
}

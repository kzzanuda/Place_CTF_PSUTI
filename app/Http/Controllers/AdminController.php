<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.menu');
    }

    public function users()
    {
      return view('admin.users')->with(['users' => User::all()]);
    }

    public function tasks()
    {
        return redirect('task/list')->with(['admin' => true]);
    }

    public function taskAdd()
    {
        return redirect()->route('admin_menu');
    }
}

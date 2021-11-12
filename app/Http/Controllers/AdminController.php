<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.menu')->with(['admin' => true]);
    }

    public function users()
    {
      return view('admin.users')->with(['users' => User::all(), 'admin' => true]);
    }

    public function tasks()
    {
        return redirect('task/list')->with(['admin' => true]);
    }

    public function add_task($id = null)
    {
        if ($id) {
          return view('admin.addtask')->with('task', Task::where('id', $id)->first());
        } else {
          return view('admin.addtask');
        }
    }
}

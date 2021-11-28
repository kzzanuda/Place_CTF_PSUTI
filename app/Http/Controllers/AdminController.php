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
      return view('admin.users')->with(['users' => User::where('role', 'user')->get()->sortByDesc(function($users){
          return $users->points();
      })]);
    }

    public function tasks()
    {
        return redirect(route('tasks.list'))->with(['admin' => true]);
    }

    public function task($id)
    {
        return route('tasks.task', ['id' => $id]);
    }

    public function taskAdd()
    {
        return view('admin.task');
    }

    public function taskEdit($id)
    {
        return view('admin.task')->with(['task' => Task::where('id', $id)->first()]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.menu')->with(['admin' => true]);
    }

    public function users(Request $request)
    {
      if($request->get('sort') == 'points'){
        return view('admin.users')->with(['users' => User::where('role', 'user')->get()->sortByDesc(function ($users) {
            return $users->points();
        })]);
      } else {
        return view('admin.users')->with(['users' => User::where('role', 'user')->orderBy('id')->get()]);
      }

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
        $file = File::where('destination', 'task')->where('destination_id', $id)->pluck('path')->first();
        if ($file) {
            $file_url = asset($file);
        }    else {
            $file_url = false;
        }

        return view('admin.task')
            ->with('task', Task::where('id', $id)->first())
            ->with('file_url', $file_url);
    }
}

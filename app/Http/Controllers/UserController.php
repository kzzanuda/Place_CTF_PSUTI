<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function profile(Request $request, $id)
    {
      $user = DB::select('select id, name, email, university from users where id = ? and active = 1', [$id]);
      $userAuth = Auth::user();

      if ($user) {
        return view('user.profile', ['user' => $user[0], 'userAuth' => $userAuth]);
      } else {
        error(404);
      }

    }

    public function update(Request $request)
    {
      $validate = $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'university' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
      ]);

      $name = $request->name;
      $university = $request->university;
      $email = $request->email;
      $updated_at = date("Y-m-d H:i:s");

      DB::table('users')->where('id', Auth::user()->id)->update(['name' => $name, 'university' => $university, 'email' => $email, 'updated_at' => $updated_at, ]);

      return redirect()->back()->with('success', 'Профиль успешно обновлен!');
    }

    public function answers($task_id, $id)
    {
      $task = Task::where('id', $task_id)->first();
      $answer = Answer::where('user_id', $id)->where('task_id', $task_id)->first();

      return view('user.answer', ['task' => $task, 'answer' => $answer]);
    }
}

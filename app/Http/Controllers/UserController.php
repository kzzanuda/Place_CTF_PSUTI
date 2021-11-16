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
        return abort('404');
      }

    }

    public function update(Request $request)
    {
      $validate = $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'university' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->getAuthIdentifier()],
      ]);

      $name = $request->name;
      $university = $request->university;
      $email = $request->email;
      $updated_at = date("Y-m-d H:i:s");

      DB::table('users')->where('id', Auth::user()->getAuthIdentifier())->update(['name' => $name, 'university' => $university, 'email' => $email, 'updated_at' => $updated_at, ]);

      return redirect()->back()->with('success', 'Профиль успешно обновлен!');
    }

    public function answer($id, $task_id)
    {
      $task = Task::where('id', $task_id)->first();
      $answer = Answer::where('user_id', $id)->where('task_id', $task_id)->first();

      if($answer){
        return view('user.answer', ['task' => $task, 'answer' => $answer]);
      } else {
        return abort('404');
      }
    }

    public function answers($id)
    {
      $answers = Answer::where('user_id', $id)
                  ->leftJoin('tasks', 'answers.task_id', '=', 'tasks.id')
                  ->select('answers.*', 'tasks.title', 'tasks.description_short')
                  ->orderBy('tasks.points')
                  ->get();

      return view('user.tasks', ['answers' => $answers, 'user_id' => $id]);
    }

    public function add_points(Request $request, $id, $task_id)
    {
      Answer::where('user_id', $id)->where('task_id', $task_id)->update(['points' => $request->points]);

      return redirect()->back()->with('success', 'Баллы проставлены в системе');
    }

    public function block($id)
    {
        User::find($id)->block();

        return redirect()->route('admin.users.list');
    }

    public function unblock($id)
    {
        User::find($id)->unblock();

        return redirect()->route('admin.users.list');
    }
}

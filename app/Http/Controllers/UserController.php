<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function profile(Request $request, $id)
    {
      $user = User::where('id', $id)->first();

      $answers = Answer::where('user_id', $id)
                  ->leftJoin('tasks', 'answers.task_id', '=', 'tasks.id')
                  ->select('answers.*', 'tasks.points')
                  ->orderBy('answers.updated_at')
                  ->get();

      if ($user) {
        return view('user.profile', ['user' => $user, 'answers' => $answers]);
      } else {
        return abort('404');
      }

    }

    public function update(Request $request)
    {
      $validate = $request->validate([
        'name' => ['required', 'max:255', 'unique:users,name,'.Auth::user()->getAuthIdentifier()],
        'university' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->getAuthIdentifier()],
        'mem0' => ['required', 'string', 'max:55'],
        'mem1' => ['max:55'],
        'mem2' => ['max:55'],
        'mem3' => ['max:55'],
        'mem4' => ['max:55'],
        'city' => ['required', 'string', 'max:255'],
        'old_password' => ['string','nullable', 'max:255'],
        'new_password' => ['string','nullable', 'max:255'],
        'new_confirm_password' => ['string','nullable', 'max:255'],
      ]);

      $user = Auth::user();

      if ($request->old_password != null) {
        if (!Hash::check($request->old_password, $user->getAuthPassword())) {
            return redirect()->back()->with('error', 'Вы ввели неправильный пароль');
        } elseif ($request->new_password != $request->new_confirm_password) {
            return redirect()->back()->with('error', 'Пароли не совпадают');
        }

        $user->password = Hash::make($request->new_password);
      }

      $membersDirt = array($request->mem0, $request->mem1, $request->mem2, $request->mem3, $request->mem4);
      $members = [];
      foreach ($membersDirt as $member) {
        if(!is_null($member)) {
          array_push($members, $member);
        }
      }

      $user->name = $request->name;
      $user->university = $request->university;
      $user->email = $request->email;
      $user->city = $request->city;
      $user->members = json_encode($members);
      $user->updated_at = date("Y-m-d H:i:s");

      $user->save();

      return redirect()->back()->with('success', 'Профиль успешно обновлен!');
    }

    public function answer($id, $task_id)
    {
        $task = Task::where('id', $task_id)->first();
        $answer = Answer::where('user_id', $id)->where('task_id', $task_id)->first();

        if ($answer) {
            return view('user.answer', ['task' => $task, 'answer' => $answer]);
        } else {
            return abort('404');
        }
    }

    public function answers($id)
    {
        $previous = User::where('role', 'user')->where('id', '<', $id)->max('id');
        $next = User::where('role', 'user')->where('id', '>', $id)->min('id');

        $answers = Answer::where('user_id', $id)
            ->leftJoin('tasks', 'answers.task_id', '=', 'tasks.id')
            ->select('answers.*', 'tasks.title', 'tasks.description_short')
            ->orderBy('tasks.points')
            ->get();
        $user = User::find($id);

        return view('user.tasks', ['answers' => $answers, 'user' => $user, 'next' => $next, 'previous' => $previous]);
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

    public function downloadCertificate()
    {
        $certificate_names = User::find(Auth::user()->getAuthIdentifier())->getCertificateName();

        foreach ($certificate_names as $certificate_name) {
            if (file_exists('files/cert/' . $certificate_name . '.pdf')) {
                return Storage::download('files/cert/' . $certificate_name . '.pdf');
            }
        }

        return abort(404);
    }
}

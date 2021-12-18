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
                  ->select('answers.*', 'tasks.category', 'tasks.points')
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
          'name' => ['required', 'string', 'max:255'],
          'university' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->getAuthIdentifier()],
          'old_password' => ['string', 'max:255'],
          'new_password' => ['string', 'max:255'],
      ]);

      $user = Auth::user();

      if (!Hash::check($request->old_password, $user->getAuthPassword())) {
          return redirect()->back()->with('error', 'Вы ввели неправильный пароль');
      }

      $user->name = $request->name;
      $user->university = $request->university;
      $user->email = $request->email;
      $user->password = Hash::make($request->new_password);
      $user->updated_at = date("Y-m-d H:i:s");

      $user->save();

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
      $user = User::find($id);

      return view('user.tasks', ['answers' => $answers, 'user' => $user]);
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

    public function showScoreboard(Request $request)
    {
      if (Auth::user()->email == 'test_user@psuti.ru') {
        return view('ctf.scoreboard')->with(['users' => User::where('role', 'user')->get()->sortByDesc(function($users){
            return $users->points();
        })]);
      } else {
        return view('ctf.scoreboard')
            ->with(['users' =>
                DB::select("
select users.id, users.name, a.updated_at, users.university, sum(points) as points
from users
    left join answers a on users.id = a.user_id
    left join tasks t on a.task_id = t.id
where users.role='user'
group by users.id
order by sum(t.points) desc, a.updated_at")]);
      }
   }

    public function downloadCertificate()
    {
        $certificate_names = User::find(Auth::user()->getAuthIdentifier())->name();

        foreach ($certificate_names as $certificate_name) {
            if (file_exists('files/cert/' . $certificate_name . '.pdf')) {
                return Storage::download('files/cert/' . $certificate_name . '.pdf');
            }
        }

        return Response('Сертификат не найден. Обратитесь к технической поддержке', 404);
    }
}

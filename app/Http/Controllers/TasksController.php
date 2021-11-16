<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'admin')
        {
            $tasks = Task::orderBy('points')->withTrashed()->orderBy('id')->get();
        } else {
            $tasks = Task::orderBy('points')->orderBy('id')->get();
        }

        return view('olimp.tasks')->with(['tasks' => $tasks]);
    }

    public function showTask($task_id)
    {
        return view('olimp.task')->with(['task' => Task::where('id', $task_id)->first()]);
    }

    public function toAnswer(Request $request, $task_id)
    {
        if($request->answer == '') {
            Answer::where('task_id', $task_id)->where('user_id', Auth::id())->delete();
        }else{
            Answer::updateOrCreate(
                ['user_id' => Auth::id(), 'task_id' => $task_id],
                ['answer' => $request->answer??'']
            );
        }

        return $this->showTask($task_id)->with(['success' => 'Ваш ответ сохранен!']);
    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        Task::withTrashed()->find($id)->update([
            'description_short' => $data['description_short'],
            'description_full' => $this->strip_tags($data['description_full']),
            'points' => $data['points'],
          #  'file' => $data['file'],
        ]);
        // return view('admin.task')
        //     ->with('task', Task::withTrashed()->where('id', $id)->first())
        //     ->with('success', true);
        return 'Задача обновлена';
    }

    public function add()
    {
        return dd("work");
    }

    public function delete($id)
    {
        Task::find($id)->delete();

        return redirect()->route('tasks.list');
    }

    public function restore($id)
    {
        Task::withTrashed()->find(1)->restore();

        return redirect()->route('tasks.list');
    }

    public function closure(Request $request)
    {
      $validate = $request->validate([
          'title' => ['required', 'string', 'max:255'],
          'description_short' => ['required', 'string', 'max:255'],
          'description_full' => ['required', 'string', 'max:40000'],
          'points' => ['required', 'integer', 'max:10'],
        ]);

        Task::create([
            'title' => $request->title,
            'description_short' => $request->description_short,
            'description_full' => $this->strip_tags($request->description_full),
            'points' => $request->points,
        ]);
        return 'Задача добавлена';      #  return redirect()->back()->with(['success' => 'Задача добавлена!']);
    }

    private function strip_tags($input) {
        $input = preg_replace('/<\/script>/', '&lt;/script&gt;', $input);
        $input = preg_replace('/<script>/', '&lt;script&gt;', $input);

        $input = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $input);

        return $input;
    }
}

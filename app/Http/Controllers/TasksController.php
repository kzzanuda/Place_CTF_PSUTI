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
        return view('olimp.tasks')->with(['tasks' => Task::orderBy('points')->orderBy('id')->get()]);
    }

    public function show_task($task_id)
    {
        return view('olimp.task')->with(['task' => Task::where('id', $task_id)->first()]);
    }

    public function to_answer(Request $request, $task_id)
    {
        if($request->answer == '') {
            Answer::where('task_id', $task_id)->where('user_id', Auth::id())->delete();
        }else{
            Answer::updateOrCreate(
                ['user_id' => Auth::id(), 'task_id' => $task_id],
                ['answer' => $request->answer??'']
            );
        }

        return $this->show_task($task_id)->with(['success' => 'Ваш ответ сохранен!']);
    }

    public function add_task(Request $request, $id = null)
    {
        $validate = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description_short' => ['required', 'string', 'max:255'],
            'description_full' => ['required', 'string', 'max:40000'],
            'points' => ['required', 'integer', 'max:10'],
        ]);
        if ($id) {
          Task::where('id', $id)->update(
            [
              'title' => $request->title,
              'description_short' => $request->description_short,
              'description_full' => $request->description_full,
              'points' => $request->points,
            ]
          );
          return redirect()->back()->with(['success' => 'Задача обновлена!']);
        } else {
          Task::create([
              'title' => $request->title,
              'description_short' => $request->description_short,
              'description_full' => $request->description_full,
              'points' => $request->points,
          ]);
          return redirect()->back()->with(['success' => 'Задача добавлена!']);
        }


    }
}

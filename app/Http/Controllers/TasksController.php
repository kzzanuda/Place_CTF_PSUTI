<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        return view('olimp.tasks')->with(['tasks' => Task::where('deleted_at', NULL)->orderBy('points')->get()]);
    }

    public function show_task($task_id)
    {
        return view('olimp.task')->with(['task' => Task::where('id', $task_id)->first()]);
    }

    public function to_answer(Request $request, $task_id)
    {
        Answer::updateOrCreate(
            ['user_id' => Auth::id(), 'task_id' => $task_id],
            ['answer' => $request->answer??'']
        );

        return $this->show_task($task_id)->with(['success' => 'Ваш ответ сохранен!']);
    }
}

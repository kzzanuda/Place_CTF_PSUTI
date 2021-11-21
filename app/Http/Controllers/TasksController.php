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
        if (Auth::user()->role == 'admin') {
            $tasks = Task::orderBy('points')->withTrashed()->orderBy('id')->get();
        } else {
            $tasks = Task::orderBy('points')->orderBy('id')->get();
        }

        return view('ctf.tasks')->with(['tasks' => $tasks]);
    }

    public function showTask($task_id)
    {
        return view('ctf.task')->with(['task' => Task::where('id', $task_id)->first()]);
    }

    public function toAnswer(Request $request, $task_id)
    {
        if ($request->answer == Task::where('id', $task_id)->first()->flag) {
            Answer::updateOrCreate(
                ['user_id' => Auth::id(), 'task_id' => $task_id],
            );
            return $this->showTask($task_id)->with(['success' => 'Верный флаг! Задача сдана.']);
        } else {
            return $this->showTask($task_id)->with(['error' => 'Неверный флаг.', 'flag' => $request->answer]);
        }


    }

    public function edit(Request $request, $id)
    {
        $data = $this->validateInput($request);

        Task::withTrashed()->find($id)->update([
          'title' => $data['title'],
          'description' => $data['description'],
          'category' => $data['category'],
          'flag' => $data['flag'],
          'points' => $data['points'],
        ]);

        return response('status', 200);
    }

    public function add(Request $request)
    {
        $data = $this->validateInput($request);

        Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'flag' => $data['flag'],
            'points' => $data['points'],
        ]);

        return response('status', 200);
    }

    public function delete($id)
    {
        Task::find($id)->delete();

        return redirect()->route('tasks.list');
    }

    public function restore($id)
    {
        Task::withTrashed()->find($id)->restore();

        return redirect()->route('tasks.list');
    }

    protected function validateInput($request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'points' => ['required', 'integer', 'max:500'],
        ]);

        return $request->all();
    }

    private function strip_tags($input)
    {
        $input = preg_replace('/<\/script>/', '&lt;/script&gt;', $input);
        $input = preg_replace('/<script>/', '&lt;script&gt;', $input);

        $input = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $input);

        return $input;
    }
}

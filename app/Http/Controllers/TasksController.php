<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ShowTasks(Request $request)
    {
        $tasks = DB::select('select id, title, description, cond from tasks_olimp where visibale = 1 order by diff');

        return view('olimp.tasks',['tasks' => $tasks]);
    }

    public function ShowTaskById(Request $request, $id)
    {
        $tasks = DB::select('select id from tasks_olimp where visibale = 1 order by diff');
        $task = DB::select('select id, title, description, cond from tasks_olimp where id = ? and visibale = 1 limit 1', [$id]);
        if ($task) {
          return view('olimp.task', ['tasks' => $tasks, 'taskid' => $task[0]]);
        } else {
          return abort(404);
        }
    }
}

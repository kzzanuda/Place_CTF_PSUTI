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
        $tasks = DB::select('select title, description, cond from tasks_olimp where visibale = 1 order by diff');

        return view('olimp.tasks',['tasks' => $tasks]);
    }
}

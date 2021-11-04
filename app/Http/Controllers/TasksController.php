<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Auth;

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

        $answers_id = [];
        if (Auth::user()) {
          $answers_id_db = DB::select('select task_id from olimp_answers where user_id = ?', [Auth::id()]);
          foreach ($answers_id_db as $answer) {
            array_push($answers_id, $answer->task_id);
          }
        }

        return view('olimp.tasks',['tasks' => $tasks, 'answers_id' => $answers_id]);
    }

    public function ShowTaskById(Request $request, $id)
    {
        $tasks = DB::select('select id from tasks_olimp where visibale = 1 order by diff');
        $task = DB::select('select id, title, description, cond from tasks_olimp where id = ? and visibale = 1 limit 1', [$id]);
        if ($task) {
          $tasksId = [];
          foreach ($tasks as $key => $value) {
            array_push($tasksId, $value->id);
          }
          $taskId = $task[0]->id;
          $baTask = array_keys($tasksId, $taskId);

          $id_old_answer = $this->giveIdOldAnswer(Auth::id(), $id);
          if ($id_old_answer) {
            $old_answer = DB::select('select id, answer from olimp_answers where id = ?', [$id_old_answer[0]->id]);
          } else {
            $old_answer = [];
          }

          return view('olimp.task', ['tasks' => $tasks, 'taskid' => $task[0], 'id' => $baTask[0], 'old_answer' => $old_answer, ]);
        } else {
          return abort(404);
        }
    }

    public function StoreAnswerTask(Request $request, $id)
    {
      $validate = $request->validate([
          'answer' => ['required', 'string', 'max:4000'],
      ]);

      $task_id = $id;
      $user_id = Auth::id();
      $answer = $request->answer;
      $updated_at = date("Y-m-d H:i:s");

      $old_answer = $this->giveIdOldAnswer($user_id, $task_id);

      if ($old_answer) {
        DB::table('olimp_answers')->where('id', $old_answer[0]->id)->update(['answer' => $answer, 'updated_at' => $updated_at, ]);
      } else {
        DB::table('olimp_answers')->insert([
            'user_id' => $user_id,
            'task_id' => $task_id,
            'answer' => $answer,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
      }

      return redirect()->back()->with('success', 'Ваш ответ сохранен!');
    }

    private function giveIdOldAnswer($user_id, $task_id)
    {
      return DB::select('select id from olimp_answers where user_id = ? and task_id = ? limit 1', [$user_id, $task_id]);
    }
}

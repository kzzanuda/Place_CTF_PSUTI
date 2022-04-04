<?php

namespace App\Http\Controllers;

use App\Models\AnswerChallange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
  public function index()
  {
      if (Auth::user()->role == 'admin') {
          $tasks = Task::orderBy('points')->withTrashed()->orderBy('id')->get();
      } else {
          $tasks = Task::orderBy('points')->orderBy('id')->get();
      }

      return view('olimp.tasks')->with(['challs' => $challs]);
  }
}

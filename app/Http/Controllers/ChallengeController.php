<?php

namespace App\Http\Controllers;

use App\Models\Challange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
  public function index()
  {
      if (Auth::user()->role == 'admin') {
          $challs = Challange::orderBy('points')->withTrashed()->orderBy('id')->get();
      } else {
          $challs = Challange::orderBy('points')->orderBy('id')->get();
      }

      return view('olimp.tasks')->with(['tasks' => $challs]);
  }
}

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
          $challenges = Challange::orderBy('points')->withTrashed()->orderBy('id')->get();
      } else {
          $challenges = Challange::orderBy('points')->orderBy('id')->where('id','<=',Auth::user()->getLvlChallange()+1)->get();
      }
      $lvl = Auth::user()->getLvlChallange();

      return view('challenge.index')->with(['challenges' => $challenges, 'lvl' => $lvl]);
  }
}

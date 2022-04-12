<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\AnswerChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
  public function index()
  {
      if (Auth::user()->role == 'admin') {
          $challenges = Challenge::withTrashed()->orderBy('id')->get();
      } else {
          $challenges = Challenge::orderBy('id')->where('id','<=',Auth::user()->getLvlChallenge()+1)->get();
      }
      $lvl = Auth::user()->getLvlChallenge();

      if (Auth::user()->getLvlChallenge() === Challenge::max('id')) {
        return view('challenge.index')->with(['challenges' => $challenges, 'lvl' => 'max', 'success' => 'Вы успешно завершили квест!']);
      } else {
        return view('challenge.index')->with(['challenges' => $challenges, 'lvl' => $lvl]);
      }
  }

  public function form()
  {
      return view('challenge.form')->with(['type' => 'add']);
  }

  public function store(Request $request)
  {
      $data = [
          'title' => $request->title,
          'description' => $request->description,
          'url' => $request->url,
          'points' => $request->points,
          'answer' => $request->answer,
      ];

      Challenge::create($data);

      return redirect(route('admin.challenge.index'));
  }

  public function edit($id)
  {
      $challenge = Challenge::find($id);

      return view('challenge.form')->with(['challenge' => $challenge, 'type' => 'edit']);
  }

  public function update($id, Request $request)
  {
      $data = [
          'title' => $request->title,
          'description' => $request->description,
          'url' => $request->url,
          'points' => $request->points,
          'answer' => $request->answer,
      ];

      $challenge = Challenge::find($id);
      $challenge->update($data);

      return redirect(route('admin.challenge.index'));
  }

  public function toAnswer(Request $request)
    {
        if (Auth::user()->getLvlChallenge() === Challenge::max('id')) return $this->index()->with(['success' => 'Вы успешно завершили квест!']);
        if ($request->answer == Challenge::where('id', Auth::user()->getLvlChallenge()+1)->first()->answer) {
            AnswerChallenge::updateOrCreate(
                ['user_id' => Auth::id(), 'chall_id' => Auth::user()->getLvlChallenge()+1],
            );
            $success = Auth::user()->getLvlChallenge() === Challenge::max('id')?'Вы успешно завершили квест!':'Верный флаг! Задача сдана.';
            return $this->index()->with(['success' => $success]);
        } else {
            return $this->index()->with(['error' => 'Неверный флаг.', 'flag' => $request->answer]);
        }
    }
}

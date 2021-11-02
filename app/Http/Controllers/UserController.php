<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Auth;

class UserController extends Controller
{
    public function ShowProfile(Request $request, $id)
    {
      $user = DB::select('select id, name, email, univers from users where id = ? and active = 1', [$id]);
      $userAuth = Auth::user();

      if ($user) {
        return view('user.profile', ['user' => $user[0], 'userAuth' => $userAuth]);
      } else {
        return abort(404);
      }

    }

    public function UpdateUser(Request $request, $id)
    {
      // code...
    }
}

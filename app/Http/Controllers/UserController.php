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
      // $users_id = DB::select('select id from users');
      // $arr_id = [];
      // foreach ($users_id as $loc_id) {
      //     array_push($arr_id, $loc_id->id);
      // }
      $user = DB::select('select id, name, email from users where id = ? and active = 1', [$id]);
      $userAuth = Auth::user();

      if ($user) {
        return view('user.profile', ['user' => $user[0], 'userAuth' => $userAuth]);
      } else {
        return abort(404);
      }

    }
}

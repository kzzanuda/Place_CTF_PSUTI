<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function ShowProfile(Request $request, $id)
    {
      $users_id = DB::select('select id from users');
      $arr_id = [];
      foreach ($users_id as $loc_id) {
          array_push($arr_id, $loc_id->id);
      }

      if (in_array($id, $arr_id)) {
        return view('user.profile', ['id' => $id]);
      } else {
        return $response->assertNotFound();
      }

    }
}

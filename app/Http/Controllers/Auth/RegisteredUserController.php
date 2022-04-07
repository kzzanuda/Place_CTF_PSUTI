<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'mem0' => ['required', 'string', 'max:55'],
            'mem1' => ['max:55'],
            'mem2' => ['max:55'],
            'mem3' => ['max:55'],
            'mem4' => ['max:55'],
            'submit' => ['required'],
            'university' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $membersDirt = array($request->mem0, $request->mem1, $request->mem2, $request->mem3, $request->mem4);
        $members = [];
        foreach ($membersDirt as $member) {
          if(!is_null($member)) {
            array_push($members, $member);
          }
        }

        $user = User::create([
            'name' => $request->name,
            'university' => $request->university,
            'city' => $request->city,
            'members' => json_encode($members),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

      return redirect(route('home'));
      #return redirect()->back()->with('success', 'Пользователь успешно создан');
    }
}

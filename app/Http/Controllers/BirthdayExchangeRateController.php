<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BirthdayExchangeRate;
use Session;

class BirthdayExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthdays = BirthdayExchangeRate::all()->sortByDesc('birthday');
        return view('index')->with('birthdays', $birthdays);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password'));

        $roles = $request['roles'];

        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();
            $user->assignRole($role_r);
            }
        }

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully added.');
             */
    }
}

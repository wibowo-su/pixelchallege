<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newfile = '';
        $def = Auth::user()->avatar;
        if ($def == 'profile.jpg') {
            $newfile = md5(Auth::user()->id) . '.png';
        } else {
            $newfile = $def;
        }

        if ($request->file('profil_picture')->isValid()) {
            $request->file('profil_picture')->move('assets/img/', $newfile);

            $user = User::find(Auth::user()->id);
            $user->avatar = $newfile;
            $user->save();
        }
        return redirect('/profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->name) || isset($request->email) || isset($request->password)) {
          $user = User::find(Auth::user()->id);
          if (!empty($request->name)) $user->name = $request->name;
          if (!empty($request->email)) $user->email = $request->email;
          if (!empty($request->password)) $user->password = bcrypt($request->password);
          $user->save();
        }else{
          $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
          ]);
        }
        return redirect('/profile');
    }
}

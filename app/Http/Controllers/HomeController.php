<?php

namespace App\Http\Controllers;

use App\Twit;
use App\Friend;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = [];
        foreach (Friend::select('friend_id')->where('user_id', Auth::user()->id)->get() as $value) {
            $friends[] = $value->friend_id;
        }

        $data = Twit::join('users', 'user_id', '=', 'users.id')
                        ->whereIn('user_id', $friends)
                        ->orWhere('user_id', Auth::user()->id)
                        ->orderBy('twits.id', 'desc')
                        ->get();
        return view('home', ['twits' => $data]);
    }
}

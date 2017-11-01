<?php

namespace App\Http\Controllers;

use App\User;
use App\Friend;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
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
        $friends = Friend::where('user_id', Auth::user()->id)->get();

        $people = [];
        foreach (User::whereNotIn('id', [Auth::user()->id])->orderBy('name')->get() as $person) {
          $person->isFriend = $this->isFriend($person->id);
          $people[] = $person;
        }

        return view('friend', [
          'friends' => $friends,
          'people' => $people,
        ]);
    }

    private function isFriend($friend_id)
    {
      return Friend::where('user_id', Auth::user()->id)->where('friend_id', $friend_id)->count() > 0;
    }

    public function store(Request $request)
    {
      $friend = new Friend;
      $friend->user_id = Auth::user()->id;
      $friend->friend_id = $request->friend_id;
      $friend->save();
      return redirect('/friend');
    }

    public function destroy($id)
    {
      $friend = Friend::where('user_id', Auth::user()->id)->where('friend_id', $id)->delete();
      return redirect('/friend');
    }
}

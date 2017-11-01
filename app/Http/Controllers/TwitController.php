<?php

namespace App\Http\Controllers;

use App\Twit;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Twit::Create([
            'user_id' => Auth::user()->id,
            'message' => $request->status
        ]);
        return redirect('/');
    }
}

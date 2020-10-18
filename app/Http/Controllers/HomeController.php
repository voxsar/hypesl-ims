<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Team;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function switchteam(Team $team)
    {
        # code...
        Auth::user()->current_team_id = $team->id;
        Auth::user()->save();
        return redirect()->back();
    }
}

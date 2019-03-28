<?php

namespace App\Http\Controllers;

use App\User;
use App\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserEmailConfirmationController;

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
        $apl = Application::select('guild_id')->where('user_id', Auth::id())->get();
        $user = User::find(Auth::id());
        return view('home',[
            'user'      => $user,
        ]);
    }
}

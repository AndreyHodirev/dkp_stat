<?php

namespace App\Http\Controllers;

use App\User;
use App\Application;
use App\Auction;
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
        $user = Auth::user();
        $buy = Auction::where('user_customer',Auth::id())->get();
        return view('home',[
            'user'      => $user,
            'buy'       => $buy,
        ]);
    }
}

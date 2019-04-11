<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Event;
use App\Http\Controllers\Controller;
 
class AjaxController extends Controller {

    public function event_status(Request $request)
    {
        $result = Event::where('guild_id', Auth::user()->guild_id)->where('event_status_id', 3)->get();
        return response()->json($result);
    }
}

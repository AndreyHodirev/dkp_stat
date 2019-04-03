<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Event;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('events.eventIndex',[
            'events' => Event::where('guild_id', Auth::user()->guild_id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        #
        if(Auth::user()->role_id <= 2)
        {
            return view('events.eventCreate',[
                'guild_id' => Auth::user()->guild_id,
                'members' => User::where('guild_id', Auth::user()->guild_id)->get(),
            ]);
        } else 
        {
            return redirect()->route('events.index')->with('status','No privileges');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::user()->role_id <= 2 && Auth::user()->guild_id == $request->input('guild_id'))
        {
            $event = new Event;
            $event->event_name = $request->input('event_name');
            $event->event_description = $request->input('event_description');
            $event->user_id = Auth::id();
            $event->guild_id = $request->input('guild_id');
            $event->event_price = $request->input('price');
            $event->save();
            if($request->input('members'))
            {
                $event->users()->attach($request->input('members'));
            }
            return redirect()->route('events.index')->with('status', 'Event CREATE!');
        } else {
            return redirect()->route('events.index')->with('status', 'No privileges');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

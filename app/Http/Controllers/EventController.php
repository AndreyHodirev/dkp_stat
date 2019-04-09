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
            'events' => Event::where('guild_id', Auth::user()->guild_id)->where('event_status_id', 1)->get(),
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
            $event->event_status_id = 1;
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
        $event = Event::find($id);
        if(Auth::user()->guild_id == $event->guild_id)
        {
            if($event->event_status_id == 4){
                return redirect()->route('events.index')->with('status','Event delete');
            } else 
            {
                return view('events.eventShow',[
                    'event' => $event,
                ]);
            }
        } else 
        {
            return redirect()->route('events.index')->with('status', 'You are not a member of the guild to which this event belongs.');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $members = User::where('guild_id', Auth::user()->guild_id)->get();
        if((Auth::user()->guild_id == $event->guild_id )  && Auth::user()->role_id <= 2 )
        {
            return view('events.eventEdit',[
                'event' => $event,
                'members' => $members,
            ]);
        } else 
        {
            return redirect()->route('events.index')->with('success', 'No privileges');
        }
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
        $event = Event::find($id);
        if(Auth::user()->role_id <= 2 && (Auth::user()->guild_id == $event->guild_id))
        {
            $event->event_name != $request->input('event_name') ? $event->event_name = $request->input('event_name') : false;
            $event->event_description != $request->input('event_description') ? $event->event_description = $request->input('event_description') : false;
            $event->guild_id != $request->input('guild_id') ? $event->guild_id = $request->input('guild_id') : false;
            $event->event_price != $request->input('price') ? $event->event_price = $request->input('price') : false;
            if($request->input('members'))
            {
                $event->users()->detach();
                $event->users()->attach($request->input('members'));
            }
            $event->save();
            return redirect()->route('events.show',[
                'id' => $id,
            ]);

        } else 
        {
            return redirect()->back();
        }
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

    public function event_success_close(Request $request)
    {
        $event = Event::find($request->input('event_id'));
        if(Auth::user()->role_id <= 2 && (Auth::user()->guild_id == $event->guild_id) && $event->event_status_id <= 2)
        {
            foreach($event->users()->pluck('id') as $user_id)
            {
                $activ_user = User::find($user_id);
                $activ_user->balance += $event->event_price;
                $activ_user->save();
            }
            // 1 - New event 2 - Procees (optional) 3 - Close 4 - Delete 
            $event->event_status_id = 3;
            $event->save();
            return redirect()->route('events.index')->with('status', 'Event CLOSE!');
        } else 
        {
            return redirect()->route('home')->with('status','Denied');
        }

        
    }

    public function event_fail_close(Request $request)
    {
        $event = Event::find($request->input('event_id'));
        if(Auth::user()->role_id <= 2 && (Auth::user()->guild_id == $event->guild_id) && $event->event_status_id <= 2)
        {
            $event->event_status_id = 3;
            $event->save();
            return redirect()->route('events.index')->with('status', 'Event CLOSE! NO REWARD');
        } else 
        {
            return redirect()->route('home')->with('status','Denied');
        }

    }

    public function event_delete(Request $request)
    {
        $event = Event::find($request->input('event_id'));
        if(Auth::user()->role_id <= 2 && ($event->guild_id == Auth::user()->guild_id) && $event->event_status_id == 3)
        {  
            $event->event_status_id = 4;
            $event->save();
            return redirect()->route('events.index')->with('status', 'Event ' . $event->name . ' delete');
        } elseif($event->event_status_id <= 2 && ((Auth::user()->role_id <= 2) && ($event->guild_id == Auth::user()->guild_id)))
        {
            return redirect()->route('events.show',['id' => $request->input('event_id')])->with('status','Before deleting an event, it must be closed.');
        } else 
        {
            return redirect()->route('home')->with('status', 'Access denied');
        }
    }
    
}

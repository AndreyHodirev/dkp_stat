<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Game;
use App\Guild;
use App\Application;
class GuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = Guild::all();
        return view('guilds.guildsIndex')->with('guilds',$guilds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::all();
        return view('guilds.guildsNew')->with('games', $games);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('logo_guild')!== null) {
            $path = $request->file('logo_guild')->store('uploads', 'public');
        } else { 
            $path = null;
        }
        $guild = new Guild;
        $guild->name = $request->input('name');
        $guild->description = $request->input('description');
        $guild->leader_id = Auth::id();
        $guild->path_logo = $path;
        $guild->game_id = $request->input('game');
        $guild->save();
        return redirect()->route('guilds.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guild = Guild::find($id);
        return view('guilds.guildsShow',[
            'guild' => Guild::find($id),
            'requests' => Application::where('guild_id', $id)->get(),
            'is_member' => $guild->user()->where('id', Auth::id())->pluck('name'),
        ]);
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
    
    public function to_join($id)
    {
        return view('guilds.guildsFormJoin',[
            'guild' => Guild::find($id),
        ]);
    }
    public function send_req(Request $request)
    {
        $guild = Guild::find($request->input('guild_id'));
        if(  $guild->users()->pluck('id')->implode('') != Auth::id())
        {
            $app = new Application;
            $app->guild_id  = $request->input('guild_id');
            $app->user_id   = Auth::id();
            $app->name      = $request->input('name');
            $app->description = $request->input('description');
            $app->save();
            return redirect()->route('home');
        } else 
        {
            return redirect()->route('guilds.show', ['id' => $request->input('guild_id') ]);
        }
    }
    public function memberAdd(Request $request)
    {
        $mngm = Guild::select('leader_id')->where('id',$request->input('guild_id'))->first();
        if(Auth::id() != $mngm->leader_id)
        {
            return redirect()->back();
        } else
        {
            $guild = Guild::find($request->input('guild_id'));
            $guild->users()->attach($request->input('user_id'));
            Application::destroy($request->input('id'));
            return redirect()->route('guilds.show',['id' => $request->input('guild_id')]);
        }
    }
}

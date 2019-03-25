<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Game;
use App\Guild;
use App\Application;
use App\User;
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
        $user = User::find(Auth::id());
        $is_leader = Guild::select('id','name')->where('leader_id', Auth::id())->first();
        $is_member = ($user->guild_id == null) ? false : Guild::find($user->guild_id);
        return view('guilds.guildsIndex',[
            'guilds' => $guilds,
            'is_leader'  => $is_leader,
            'is_member'  => $is_member,
        ]);
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
        $user = User::find(Auth::id());
        $guild = new Guild;
        $guild->name = $request->input('name');
        $guild->description = $request->input('description');
        $guild->leader_id = Auth::id();
        $guild->path_logo = $path;
        $guild->game_id = $request->input('game');
        $guild->save();
        $user->guild_id = $guild->id;
        $user->save();
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
            'members' => User::select('name', 'id')->where('guild_id', $id)->get(),
            'activ_user' => User::find(Auth::id()),
            'requests' => Application::where('guild_id', $id)->get(),
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
        $user = User::find(Auth::id());
        if($user->guild_id == null)
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
        $user = User::find($request->user_id);
        if(Auth::id() != $mngm->leader_id)
        {
            return redirect()->back();
        } else
        {
            Application::destroy($request->input('id'));
            $user->guild_id = $request->input('guild_id');
            $user->save();
            return redirect()->route('guilds.show',['id' => $request->input('guild_id')]);
        }
    }
    public function exitMember(Request $request)
    {
        if($request->input('user_id') == Auth::id())
        {
            $user = User::find(Auth::id());
            $user->guild_id = null;
            $user->save();
            return redirect()->route('guilds.index');
        } else 
        {
            return redirect()->back();
        }
    }
}

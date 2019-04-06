<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Game;
use App\Guild;
use App\Application;
use App\User;
use App\Auction;
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
        $user->role_id = 1;
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
        $user = User::find(Auth::id());
        $guild = Guild::find($id);
        if(!isset($guild)) {
            return redirect()->route('home');
        }
        if($user->guild_id != $guild->id)
        {
            return redirect()->route('guild.guildPromo',['id' => $guild->id]);
        }
        return view('guilds.guildsShow',[
            'guild' => Guild::find($id),
            'members' => User::where('guild_id', $id)->get(),
            'activ_user' => User::find(Auth::id()),
            'requests' => Application::where('guild_id', $id)->where('status_id', 1)->get(),
            'auctions' => Auction::where('guild_id', $id)->where('auc_status_id', 1)->get(),
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
        $guild = Guild::find($id);
        if($guild->leader_id == Auth::id())
        {
             return view('guilds.guildsEdit',[
                        'guild' => $guild,
                        ]);
        } else 
        {
            return redirect()->back();
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
        $user = User::find(Auth::id());
        $guild = Guild::find($id);
        if($user->id == $guild->leader_id)
        {
            $guild->name = $request->input('name');
            $guild->description = $request->input('description');
            $guild->save();
            return redirect()->route('guilds.show', ['id' => $id]);
        } else 
        {
            return redirect()-back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guild = Guild::find($id);
        $user = User::find(Auth::id());
        if($guild->leader_id == $user->id)
        {
            $user = User::select('id','guild_id')->where('guild_id',$id)->get();
            foreach($user as $us)
            {
                $us->guild_id = null;
                $us->save();
            }

            $guild->delete();
            $user->guild_id = null;
            $user->role_id = 5;
            return redirect()->route('guilds.index')->with('success', 'guild delete =( ');
        }
    }
    
    public function to_join($id)
    {
        return view('guilds.guildsFormJoin',[
            'guild' => Guild::find($id),
            'auser' => Auth::user(),
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
            $app->status_id = 1;
            $app->save();
            $user->role_id = 4;
            $user->save();
            return redirect()->route('home');
        } else 
        {
            return redirect()->route('guilds.show', ['id' => $user->guild_id]);
        }
    }
    public function memberAdd(Request $request)
    {
        $guild = Guild::find($request->input('guild_id'));
        $user = User::find($request->user_id);
        $activ_user = User::find(Auth::id());
        $appl = Application::find($request->input('id'));
        if(($activ_user->role_id == 1 || $activ_user->role_id == 2) && $activ_user->guild_id == $guild->id)
        {
            $appl->status_id = 2;
            $appl->save();
            $user->guild_id = $request->input('guild_id');
            $user->role_id = 3;
            $user->save();
            return redirect()->route('guilds.show',['id' => $request->input('guild_id')]);
        } else
        {
            return redirect()->back();
        }
    }
    public function userException(Request $request)
    {
        $activ_us = User::find(Auth::id());
        $guild = Guild::find($request->input('guild_id'));
        if(($activ_us->role_id == 1 || $activ_us->role_id == 2) && $activ_us->guild_id == $guild->id) // if leader  or office
        {
            $user = User::find($request->input('user_id'));
            $user->guild_id = null;
            $user->role_id = 5;
            $user->save();
            return redirect()->back();
        } else 
        {
            return redirect()->back();
        }
    }

    public function exitMember(Request $request)
    {
        if($request->input('user_id') == Auth::id())
        {
            $user = User::find(Auth::id());
            $user->guild_id = null;
            $user->role_id = 5;
            $user->save();
            return redirect()->route('guilds.index');
        } else 
        {
            return redirect()->back();
        }
    }
    public function promoPage($id)
    {
        $guild = Guild::find($id);

        return view('guilds.promo',[
            'guild' => $guild,
        ]);
    }
    public function cce(Request $request)
    {
        $applic = Application::find($request->input('id'));
        $user = User::find($applic->user_id);
        if(Auth::user()->role_id <= 2 && (Auth::user()->guild_id == $applic->guild_id))
        {
            $applic->status_id = 3;
            $user->role_id = 4;
            $applic->save();
            $user->save();
            return redirect()->back();
        } else 
        {
            return redirect()->route('home');
        }
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $searchResult = Guild::where('name', 'LIKE', "%$search%")->get();
        return view('guilds.guildsSearchResult',[
            'guilds' => $searchResult,
        ]);
    }
}

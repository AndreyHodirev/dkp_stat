@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild {{$guild->name}}</h1>
        <h3>Logo guild : <img src="{{asset('/storage/' . $guild->path_logo)}}" alt=""></h3>
    </div>
    <div class="container">
        <div>
            @if($activ_user->guild_id == null)
                <a href="{{route('guild.join',['id' => $guild->id])}}" class="btn btn-warning">Join the guild</a>
            @elseif($activ_user->guild_id != $guild->id)
                <a href="{{route('guilds.show',['id' => $activ_user->guild_id])}}">You are a member of another guild: {{$activ_user->guildM->name}}</a>
            @else 
                <p>You are a member of this guild.</p>
            @endif
        </div>
    </div>
    <div class="container">
       <div class="col-sm-6">
           <h1>Members : </h1>
           @foreach($members as $mb)
               <p> <a href="">{{$mb->name}}</a></p>
           @endforeach

       </div>
       <div class="col-sm-6">
        @if($guild->leader_id == $activ_user->id)
           <h1>Incoming claims : </h1>
           @foreach($requests as $rq)
                User name :  {{$rq->name}} <br>
                Description : {{$rq->description}}
                <form action="{{route('guild.add_new_member')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$rq->id}}">
                    <input type="hidden" name="guild_id" value="{{$guild->id}}">
                    <input type="hidden" name="user_id" value="{{$rq->user_id}}">
                    <input type="hidden" name="name" value="{{$rq->name}}">
                    <input type="hidden" name="description" value="{{$rq->description}}">
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
           @endforeach
        @else 
            <p>Entry applications can only be seen by the leader or officers</p>
        @endif
       </div>
    </div>
@stop 
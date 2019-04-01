@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild {{$guild->name}}</h1>
        <h3>Logo guild : <img src="{{asset('/storage/' . $guild->path_logo)}}" alt=""></h3>
    </div>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif  
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
        @if($activ_user->id == $guild->leader_id) 
            <a href="{{route('guilds.edit',['id' => $guild->id])}}">Edit guild</a>
        @endif
       <div class="col-sm-6">
           <h1>Members : </h1>
           @foreach($members as $mb)
               <p> <a href="">{{$mb->name}}</a> Role : {{$mb->role->role_name}}
                @if($activ_user->id == $guild->leader_id && $activ_user->id != $mb->id)
                <form action="{{route('guild.usException')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$guild->id}}" name="guild_id">
                    <input type="hidden" value="{{$mb->id}}" name="user_id">
                    <button class="btn btn-allert" type="submit">Exception</button>
                </form></p>
                @endif
           @endforeach

       </div>
       <div class="col-sm-12">
        @if($activ_user->role_id == 1 || $activ_user->role_id == 2)
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
                <form action="{{route('guild.cencel')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$rq->id}}">
                    <button type="submit" class="btn btn-alert">CENCEL</button>
                </form>
            @endforeach           
        @else 
            <p>Entry applications can only be seen by the leader or officers</p>
        @endif
       </div>
       <h2>Auctions: </h2>
       @if($activ_user->role_id <= 2)
            <a href="{{route('auction.create')}}" class="btn btn-primary">Add item</a> 
       @endif
            <a href="{{route('auction.index')}}" class="btn btn-info">All info</a>
       @foreach($auctions as $auc)
            <p>{{$auc->item_name}} Price : {{$auc->price}}</p> <a href="{{route('auc.buy',['id'=> $auc->id])}}">Buy</a>
       @endforeach

       @if($activ_user->id == $guild->leader_id)
            <form action="{{route('guilds.destroy',['id' => $guild->id])}}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-alert">DELETE GUILD</button>
            </form>
       @elseif($activ_user->guild_id == $guild->id)
            <form action="{{route('guild.exitMember')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{$activ_user->id}}">
                <button class="btn btn-alert" type="submit">EXIT GUILD</button>
            </form>
            
       @else
            <p>NO MEMBER</p>
       @endif

    </div>
@stop 
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild list</h1>
        @if($is_leader != null)
            <p>You are the leader of the guild: <a href="{{route('guilds.show',['id'=>$is_leader->id])}}">{{$is_leader->name}}</a></p>
        @elseif($is_member != false)
            <p>You are a member of the guild: <a href="{{route('guilds.show',['id'=>$is_member->id]) }}">{{$is_member->name}}</a></p>
        @else
            <a href="{{ route('guilds.create')}}" class="btn btn-primary"> Create guild</a>
            <hr>
        @endif
    </div>
    <div class="container">
        @foreach($guilds as $guild)
            @isset($guild->path_logo)
                <img class="img-fluid" src="{{ asset('/storage/' . $guild->path_logo)}}" alt="" width="50px" height="50px">
            @endisset
            <p>Guild name : {{ $guild->name }}</p>  
            <p>Guild description : {{ $guild->description }} </p>
            <p>Guild Leader : {{ $guild->user->name }}</p>
            <p>Game : {{ $guild->game->name }}</p>
            <a href="{{route('guilds.show',['id' => $guild->id])}}">GUILD PROFILE</a>
        @endforeach 
        
    </div>
@stop 
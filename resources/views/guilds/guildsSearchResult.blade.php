@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search result, Guilds : </h1>
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
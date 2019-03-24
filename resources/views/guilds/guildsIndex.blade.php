@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild list</h1>
        <a href="{{ route('guilds.create')}}" class="btn btn-primary"> Create guild</a>
        <hr>
    </div>
    <div class="container">
        @foreach($guilds as $guild)
            @isset($guild->path_logo)
                <img class="img-fluid" src="{{ asset('/storage/' . $guild->path_logo)}}" alt="" width="50px" height="50px">
            @endisset
            {{ $guild->name }} <br>
            {{ $guild->description }} <br>
            <p>Guild Leader : {{ $guild->user->name }}</p>
            <p>Game : {{ $guild->game->name }}</p>
        @endforeach 
        
    </div>
@stop 
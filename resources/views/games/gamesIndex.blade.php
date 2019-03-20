@extends('layouts.app')

@section('content')
    <div class="container">
            <h1>Game list</h1>
            <a href="{{ route('games.create')}}" class="btn btn-primary">Create new game</a>
    </div>
    <div class="container">
        @foreach($games as $game)
            @isset($game->logo_path)
                <img class="img-fluid" src="{{ asset('/storage/'.$game->logo_path) }}" alt="" width="50px" height="50px">
            @endisset
            {{$game->name}}
            <p>{{$game->description }}</p>
            <hr>
        @endforeach
    </div>
@stop 
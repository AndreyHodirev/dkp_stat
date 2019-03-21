@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('guilds.store')}}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            {{csrf_field()}}
            <label for="game">GAME : </label> <br>
            <select name="game" id="game_id">
                <option value="0">Click & Select Game</option>
                @foreach($games as $game)
                    <option value="{{$game->id}}">{{$game->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Enter name guild : </label><br>
            <input type="text" name="name">
        </div>
        <div class="form-group">
            <label for="description"> Enter Description guild : </label><br>
            <input type="text" name="description">
        </div>
        <div class="form-group">
            <label for="logo"> Select logo guild : </label><br>
            <input type="file" name="logo_guild">
        </div>
            <button type="submit" class="btn btn-primary"> Create!</button>
        </form>
    </div>
    
@stop 
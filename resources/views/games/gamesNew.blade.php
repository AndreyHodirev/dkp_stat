@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new game</h1>

        <form action="{{ route('games.store')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Game : </label><br>
                <input type="text" name="name" placeholder="Enter game name">
            </div>
            <div class="form-group">
                <label for="description"> Description : </label><br>
                <input type="text" name="description" placeholder="Enter description">
            </div>
            <div class="form-group">
                <label for="logo">Select game logo : </label><br>
                <input type="file" name="logo">    
            </div>            
            <button btn btn-default type="submit">TEST</button>

            @isset($path)
                <img class="img-fluid" src="{{ asset('/storage/'.$path) }}" alt="">
            @endisset
        </form>
    </div>
@stop 
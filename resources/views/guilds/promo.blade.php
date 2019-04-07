
@extends('layouts.app')

@section('content')
    <div class="container">
            <h1>PROMO</h1>
            <a href="{{route('guild.join',['id' => $guild->id])}}" class="btn btn-warning btn-block">Join the guild</a>            
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
            <h1>PROMO</h1>
            <a href="{{route('guild.join',['id' => $guild->id])}}" class="btn btn-warning btn-block">Join the guild</a> 
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h2>Events end : {{$events_end}}</h2>    
            </div>
            <div class="col-sm">
                <h2>Members : {{$members_count}}</h2>
            </div>
            <div class="col-sm">
                <h2>Auction end : {{$auction_end}}</h2>
            </div>
        </div>
    </div>
@endsection
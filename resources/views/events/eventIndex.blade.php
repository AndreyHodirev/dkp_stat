@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif  
        <h2>Events : <a href="{{route('events.create')}}" class="btn btn-success">Create Event</a></h2>
        
        @foreach($events as $event)
            <div class="jumbotron">
                <h1 class="display-4">{{$event->event_name}}</h1>
                <p class="lead">{{$event->event_description}}</p>
                <hr class="my-4">
                <p>Event price : {{$event->event_price}} points.</p>
                <p>Event leader : {{$event->user->name}}</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="{{route('events.show',['id' => $event->id])}}" role="button">Learn more</a>
                </p>     
            </div>
        @endforeach
        
    </div>
@stop 
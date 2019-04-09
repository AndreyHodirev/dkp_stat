@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif  
        <h2>Events : <a href="{{route('events.create')}}" class="btn btn-success">Create Event</a></h2>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <a href="" class="btn btn-success btn-block">Show end events</a>
                </div>
                <div class="col-sm">
                    <a href="" class="btn btn-warning btn-block">Show delte events</a>
                </div>
            </div>
        </div>
        @foreach($events as $event)
            <div class="jumbotron">
                <h1 class="display-4">{{$event->event_name}}</h1>
                <p class="lead">{{$event->event_description}}</p>
                <hr class="my-4">
                <p>Event price : {{$event->event_price}} points.</p>
                <p>Event leader : {{$event->user->name}}</p>
                <p>Event status : {{$event->status->name}}</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="{{route('events.show',['id' => $event->id])}}" role="button">Learn more</a>
                </p>     
            </div>
        @endforeach
        
    </div>
@stop 
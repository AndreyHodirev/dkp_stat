@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif 
        <div class="jumbotron">
                <div class="jumbotron">
                    <h1 class="display-4">{{$event->event_name}}</h1>
                    <p class="lead">{{$event->event_description}}</p>
                    <hr class="my-4">
                    <p>Event price : {{$event->event_price}} points.</p>
                    <p>Event leader : {{$event->user->name}}</p>
                    <p>Event status : {{$event->status->name}}</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="{{route('events.edit',['id' => $event->id])}}" role="button">Edit event</a>
                    </p>     
               
                </div>
        </div> 
    </div>
@stop 
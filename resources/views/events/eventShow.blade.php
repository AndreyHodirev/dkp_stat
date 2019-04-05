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
                        <a class="btn btn-primary" href="{{route('events.edit',['id' => $event->id])}}" role="button">Edit event</a>
                        @if(Auth::user()->role_id <= 2 && (Auth::user()->guild_id == $event->guild_id) && $event->event_status_id <= 2)
                            <form action="{{route('events.close_event_success')}}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{$event->id}}">
                                <button type="submit" class="btn btn-success">Close and pay reward</button>
                            </form>
                            <form action="{{route('events.close_event_fail')}}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{$event->id}}">
                                <button type="submit" class="btn btn-danger">Close without payment</button>
                            </form>
                        @elseif(Auth::user()->role_id <= 2 && (Auth::user()->guild_id == $event->guild_id))
                            <form action="{{route('events.event_delete')}}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{$event->id}}">
                                <button type="submit" class="btn btn-danger">DELETE EVENT</button>
                            </form>
                        @endif
                    </p>     
                </div>
        </div> 
    </div>
@stop 
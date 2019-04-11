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
                    <button class="btn btn-success btn-block" id="end_events">Show end events</button>
                </div>
                <div class="col-sm">
                    <button class="btn btn-warning btn-block" id="delete_events">Show delte events</button>
                </div>
            </div>
        </div>
        @foreach($events as $event)
            <div class="jumbotron" id="first">
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
        <div class="jumbotron" id="second_content">

        </div>
    </div>

    <script>
        $('#end_events').bind('click', function(){
            var token = $('meta[name="csrf-token"]').attr('content');
            var data = {};
            // data['_token'] = token;
            data['status'] = 2;
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/ev_status',
                data: data,
                dataType:"json",
                success: function(data){
                    $('#first').empty();
                    $('#second_content').empty();
                    $(data).each(function(index, value){
                        $(value).each(function(i, event){
                            $('#second_content').append(
                                'Event name : ' + event.event_name + '<br> Event description : ' + event.event_description + ' <br> Event price : ' + event.event_price + '<hr>'
                            );
                        });
                    });
                },error:function(){
                    alert('Error!!!');
                }
            });
        });
    </script>
@stop 
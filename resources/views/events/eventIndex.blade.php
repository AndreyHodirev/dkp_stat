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
        <div class="container" id="default_table">
            <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Event Name</th>
                                <th scope="col">Event Price</th>
                                <th scope="col">Event Leader</th>
                                <th scope="col">Event Status</th>
                                <th scope="col">INFO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <th>{{$event->event_name}}</th>
                                    <td>{{$event->event_price}} points</td>
                                    <td>{{$event->user->name}}</td>
                                    <td>{{$event->status->name}}</td>
                                    <td><a href="{{route('events.show',['id' => $event->id])}}" class="btn btn-primary btn-sm">Learn more</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    
                    </table>
            </div>
        </div>
        <div class="container" id="second_table">
            <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Event Name</th>
                                <th scope="col">Event Price</th>
                                <th scope="col">INFO</th>
                            </tr>
                        </thead>
                        <tbody id="second_table_body">
                            
                        </tbody>    
                    </table>
            </div>
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
                    $('#default_table').empty();
                    $('#second_table_body').empty();
                    route = 'events.show';
                    $(data).each(function(index, value){
                        $(value).each(function(i, event){
                            id = event.id;
                            $('#second_table_body').append(
                                '<tr><th>' + event.event_name + '</th>' + 
                                '<th>' + event.event_price + '</th>' +
                                '<th><a href="{{route("events.show",["id" => ])}}" class="btn btn-primary btn-sm">Learn more</a></th></tr>' 
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
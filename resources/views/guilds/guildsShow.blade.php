@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild {{$guild->name}}</h1>
        @if($is_member == null)
            <a href="{{route('guild.join',['id'=> $guild->id])}}" class="btn btn-primary">Send request</a>
        @else 
            <h1>YOU MEMBER</h1>
        @endif
        <h3>Logo guild : <img src="{{asset('/storage/' . $guild->path_logo)}}" alt=""></h3>
    </div>
    <div class="container">
       <div class="col-sm-6">
           <h1>Members : </h1>
            @foreach($guild->users()->pluck('name') as $g_u)
                <p>{{$g_u}}</p>
            @endforeach
       </div>
       <div class="col-sm-6">
           <h1>Incoming claims : </h1>
          
           @foreach($requests as $rq)
                User name :  {{$rq->name}} <br>
                Description : {{$rq->description}}
                <form action="{{route('guild.add_new_member')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$rq->id}}">
                    <input type="hidden" name="guild_id" value="{{$guild->id}}">
                    <input type="hidden" name="user_id" value="{{$rq->user_id}}">
                    <input type="hidden" name="name" value="{{$rq->name}}">
                    <input type="hidden" name="description" value="{{$rq->description}}">
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
           @endforeach
       </div>
    </div>
@stop 
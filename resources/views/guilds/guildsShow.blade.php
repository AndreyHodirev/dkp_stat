@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild {{$guild->name}}</h1>
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
           <h1>Entry applications : </h1>
       </div>
    </div>
@stop 
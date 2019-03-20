@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guild list</h1>
        <a href="{{ route('guilds.create')}}" class="btn btn-primary"> Create guild</a>
    </div>
    
@stop 
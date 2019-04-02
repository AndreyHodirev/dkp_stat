@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif  
        <h2>Events : <a href="{{route('events.create')}}" class="btn btn-success">Create Event</a></h2>
    </div>
@stop 
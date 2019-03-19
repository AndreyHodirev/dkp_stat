@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2>Get confirmation link</h2>   
        <form method="POST" action="{{route('send-confirmation-email', $user )}}">
            {{csrf_field() }}
            <input type="hidden" value="{{ $user->email}}" name="email">
            <input type="submit" class="btn btn-primary" value="Send!">
        </form>
        {{ $user->email }}
    </div>    

@stop 
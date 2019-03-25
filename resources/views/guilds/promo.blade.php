
@extends('layouts.app')

@section('content')
<h1>PROMO</h1>
<a href="{{route('guild.join',['id' => $guild->id])}}" class="btn btn-warning">Join the guild</a>
@endsection
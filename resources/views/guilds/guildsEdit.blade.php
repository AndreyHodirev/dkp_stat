
@extends('layouts.app')

@section('content')
Edit form her
<div class="container">
    <form action="{{route('guilds.update',['id' => $guild->id])}}" method="POST" class="form-control">
        @method('PATCH')
        @csrf 
        <label for="">Guild name : </label>
        <input type="text" name="name" value="{{$guild->name}}">

        <label for="">Guild description : </label>
        <textarea name="description" id="description" cols="30" rows="10">
            {{$guild->description}}
        </textarea>
        <input type="hidden" name="guild_id" value="{{$guild->id}}">
        <button type="submit" class="btn btn-primary">UPDATE</button>
    </form>
</div>


@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif 
        <form action="{{route('events.store')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="guild_id" value="{{$guild_id}}">
            <label for="event_name">Event name</label>
            <input type="text" name="event_name" placeholder="Raid Antharas"  class="form-control">
            <label for="event_description">Event description</label>
            <textarea name="event_description" class="form-control" cols="30" rows="10" placeholder="Regroup Giran 22.00 01.01.2022">
            </textarea>
            <label for="price">Price (points) : </label>
            <input type="text" name="price" class="form-control" placeholder="100">
            <label for="members"> Select Members : </label>
            <select multiple class="form-control" name="members" id="member">
            @foreach($members as $memb)
                <option value="{{$memb->id}}">
                <div class="form-check">   
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                        {{$memb->name}}
                        </label>
                </div>
                </option>
            @endforeach
            </select>
            <button type="submit" class="btn btn-success">CREATE EVENT</button>
        </form>
    </div>
@stop 
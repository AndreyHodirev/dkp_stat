@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('guild.request_new')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name" class="">Enter you name : </label>
                <input type="text" name="name" placeholder="Andrii / Mark / Viktor" class="form-control">
            </div>
            <div class="form-group">
                <label for="description" class="">Description : </label>
                <textarea class="form-control" type="text" name="description" cols="50" rows="5">
                    @if($guild->requirements != null)
                        {{$guild->requirements}}
                    @else 
                        Enter you info
                    @endif
                </textarea>
            </div>
            <input type="hidden" name="user_id" id="user_id" value="{{$auser->id}}">
            <input type="hidden" name="guild_id" id="guild_id" value="{{$guild->id}}">
            <button type="submit">SEND!</button>
        </form>
    </div>
    <script>
    </script>
@stop 
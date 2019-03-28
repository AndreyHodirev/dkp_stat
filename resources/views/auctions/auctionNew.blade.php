@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('auction.store')}}" method="POST">
            {{csrf_field()}}
                <input type="text" name="item_name" placeholder="Name" class="form-control">
                <input type="text" name="item_description" placeholder="Description" class="form-control">
                <input type="text" name="price" placeholder="20000" class="form-control">
            <input type="hidden" name="guild_id" value="{{$guild_id}}">
            <button class="btn btn-primary form-control">CREATE AUC</button>
        </form>
    </div>
    
@endsection
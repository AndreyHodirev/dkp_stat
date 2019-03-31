@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('auction.store')}}" method="POST">
            {{csrf_field()}}
                <label for="item_name">Item Name : </label>
                <input type="text" name="item_name" placeholder="Name" class="form-control">
                <label for="item_description">Item Description : </label>
                <input type="text" name="item_description" placeholder="Description" class="form-control">
                <label for="price">Item Price : </label>
                <input type="text" name="price" placeholder="20000" class="form-control">
                <input type="hidden" name="guild_id" value="{{$guild_id}}">
            <button class="btn btn-primary form-control">CREATE AUC</button>
        </form>
    </div>
    
@endsection
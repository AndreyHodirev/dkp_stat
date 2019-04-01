
@extends('layouts.app')

@section('content')

<div class="container">
        Edit form her
    <form action="{{route('auction.update',['id' => $item->id])}}" method="POST" class="">
        @method('PATCH')
        @csrf 
        <label for="item_name">Item Name </label>
        <input type="text" name="item_name" class="form-control" value="{{$item->item_name}}">
        <label for="description">Description </label>
        <input type="text" name="description" class="form-control" value="{{$item->description}}">
        <label for="price">Price </label>
        <input type="text" name="price" class="form-control" value="{{$item->price}}">

        <button type="submit" class="btn btn-primary">UPDATE</button>
    </form>
</div>


@endsection
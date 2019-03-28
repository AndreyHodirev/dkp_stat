@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All auctions</h2>
        @foreach($items as $item )
            <p>{{$item->item_name}} Price : {{$item->price}}</p>
        @endforeach
    </div>
    
@endsection
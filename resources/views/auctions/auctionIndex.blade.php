@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All auctions</h2>
        @foreach($items as $item )
            <p>{{$item->item_name}} Price : {{$item->price}}</p> 
           
            <p>{{$item->description}}</p>
            <p>Status :  {{$item->status->name}}</p>
            @if($edit_visible)
                <a href="{{route('auction.edit', ['id' => $item->id])}}">Edit</a>
             @endif
            <hr>
        @endforeach
    </div>
    
@endsection
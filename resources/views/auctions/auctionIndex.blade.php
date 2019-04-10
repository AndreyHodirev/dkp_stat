@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All auctions</h2>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <a href="" class="btn btn-success btn-block">Add new item</a>
                </div>
                <div class="col-sm">
                    <a href="" class="btn btn-primary btn-block">Show purchased items </a>
                </div>
                <div class="col-sm">
                    <a href="" class="btn btn-warning btn-block">Show hidden items</a>
                </div>
            </div>
        </div>
        <hr>
        @foreach($items as $item )
            <p>{{$item->item_name}} Price : {{$item->price}}</p> 
           
            <p>{{$item->description}}</p>
            <p>Status :  {{$item->status->name}}</p>
            <a href="{{route('auc.buy',['id' => $item->id])}}" class="btn btn-success">Buy ITEM</a>
            @if($edit_visible)
                <a href="{{route('auction.edit', ['id' => $item->id])}}" class="btn btn-success">Edit</a>
                <a href="{{route('auc.closeOrder',['id' => $item->id])}}" class="btn btn-danger">CLOSE ORDER</a>
            @endif
            <hr>
        @endforeach
    </div>
    
@endsection
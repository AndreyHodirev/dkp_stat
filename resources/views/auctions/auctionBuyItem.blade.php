@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif  
        <p>Item name : {{$item->item_name}}</p>
        <p>Price : {{$item->price}} point!  You balance : {{$user->balance}} </p>
        <form action="{{route('auc.buyConfirm')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <button type="submit" class="btn btn-primary">BUY ITEM!</button>
        </form>
    </div>
@endsection
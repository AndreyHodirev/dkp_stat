@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in! <br>
                    You are in such guilds as:
                    @foreach($user->guilds()->pluck('id') as $gg)
                      <hr><a href="{{route('guilds.show', ['id' => $gg])}}">{{$user->guilds()->where('id', $gg)->pluck('name')->implode('')}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

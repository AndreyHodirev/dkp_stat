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
                    You guild:
                    @if($user->guild_id != null)
                        <a href="{{route('guilds.show',['id' => $user->guildM->id])}}">{{$user->guildM->name}}</a>
                        
                    @else 
                        <p>No GUILD</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

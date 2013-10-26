@extends('layouts.master')

@section('title')
@parent
- Home
@stop

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Welcome {{ Auth::user()->username }}</h1>
        <p>You have succesfully logged in.</p>
    </div>
</div>
    
<div class="container">
    <h1>Most recent</h1>
        <div class="row">
            @foreach($recentEpisodes as $episode)
            <div class="col-md-3" style="margin-top:10px;">
                <div class="thumbnail">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            <img class="media-object" src="public/img/episodelogos/{{ $episode->iconFile }}" alt="User avatar" width="64" height="64">
                        </div>
                        <div class="col-md-8"><a href="/compod/compod/server.php/episode/{{$episode->id}}">{{$episode->title}}</a></div>    
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
</div>

@stop
    
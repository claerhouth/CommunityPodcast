@extends('layouts.master')

@section('title')
@parent
 - Episode Overview
@stop

@section('content')
<h1>Showing all episodes @if ($own == 1) created by {{ Auth::user()->username }} @endif</h1>
<ul>
    @foreach($episodes as $episode)
    <li class="list-group-item" style="min-height:84px;">
        <div class="col-md-1">
            <a href="/compod/compod/server.php/episode/{{$episode->episode_id}}">
                <img class="media-object" src="../public/img/episodelogos/{{ $episode->episode_icon }}" alt="Episode icon" width="64" height="64">
            </a>
        </div>
        <div>
            <span class="pull-right"><a href="/compod/compod/server.php/podcast/{{$episode->podcast_id}}">{{$episode->podcast_name}}</a></span>
            <a href="/compod/compod/server.php/episode/{{$episode->episode_id}}"><b>{{$episode->episode_title}}</b></a>  <em> - {{$episode->episode_date}}</em><br>
            <p><em>{{$episode->episode_desc}}</em></p>
        </div>
    </li>
  @endforeach
</ul>
@stop
    
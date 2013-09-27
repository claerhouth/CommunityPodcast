@extends('layouts.master')

@section('title')
@parent
 - Episode Overview
@stop

@section('content')
<h1>Showing all episodes @if ($own == 1) created by {{ Auth::user()->username }} @endif</h1>
<ul>
    @foreach($episodes as $episode)
    <li class="list-group-item">
        <span class="pull-right"><a href="/compod/compod/server.php/podcast/{{$episode->podcast_id}}">{{$episode->podcast_name}}</a></span>
        <a href="/compod/compod/server.php/episode/{{$episode->episode_id}}"><b>{{$episode->episode_title}}</b></a>  <em> - {{$episode->episode_date}}</em><br>
        <p>{{$episode->episode_desc}}</p>
    </li>
  @endforeach
</ul>
@stop
    
@extends('layouts.master')

@section('title')
@parent
 - Episode Overview
@stop

@section('content')
<h1>Showing all episodes created by {{ Auth::user()->username }}</h1>
<ul>
    @foreach($episodes as $episode)
    <li class="list-group-item">
        <span class="badge">{{$episode->podcast_name}}</span>
        <b>{{$episode->episode_title}}</b>  <em> - {{$episode->episode_date}}</em><br>
        <p>{{$episode->episode_desc}}</p>
    </li>
  @endforeach
</ul>
@stop
    
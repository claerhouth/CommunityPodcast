@extends('layouts.master')

@section('title')
@parent
- Podcast Overview
@stop

@section('content')
<h1>Showing all podcasts @if ($own == 1) created by {{ Auth::user()->username }} @endif</h1>
<ul>
    @foreach($podcasts as $podcast)
    <li class="list-group-item">
        <b>{{$podcast->name}}</b> <em> - {{$podcast->description}}</em>
    </li>
  @endforeach
</ul>
@stop
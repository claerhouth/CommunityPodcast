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
        <div class="row">
            <div class="span9"><b>{{$podcast->name}}</b> <em> - {{$podcast->description}}</em></div>
            
            <div class="span2">
                @if ($podcast->isSubscribed)
                    <a href="/compod/compod/server.php/unsubscribe/{{$podcast->id}}"><button class="btn btn-danger">Unsubscribe</button></a>
                @else
                    <a href="/compod/compod/server.php/subscribe/{{$podcast->id}}"><button class="btn btn-success">Subscribe</button></a>
                @endif
            </div>
        </div>
    </li>
  @endforeach
</ul>
@stop
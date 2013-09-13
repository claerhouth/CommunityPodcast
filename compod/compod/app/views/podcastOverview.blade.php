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
            <div class="span10"><b>{{$podcast->name}}</b> <em> - {{$podcast->description}}</em></div>
            
            @if ($own == 0)
            <div class="span1">
                @if (!$podcast->creator)
                    @if ($podcast->isSubscribed)
                        <a href="/compod/compod/server.php/unsubscribe/{{$podcast->id}}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button></a>
                    @else
                        <a href="/compod/compod/server.php/subscribe/{{$podcast->id}}"><button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></button></a>
                    @endif
                @else
                    <p class="text-info">creator</p>
                @endif
            </div>
            @endif
        </div>
    </li>
  @endforeach
</ul>
@stop
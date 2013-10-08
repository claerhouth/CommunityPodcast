@extends('layouts.master')

@section('title')
@parent
- Podcast Overview
@stop

@section('content')

@if ($search != "")
<h1>Showing podcasts for {{$search}}</h1>
@else
<h1>Showing all podcasts @if ($own == 1) created by {{ Auth::user()->username }} @endif</h1>
@endif

@if (sizeof($podcasts) == 0 && $search != "")

  <div>It appears there currently aren't any podcasts about {{$search}}.</div>
  <div>
          Why don't you start things up and
          <a href="/compod/compod/server.php/addPodcast"><button type="button" class="btn btn-primary btn-xs">Create one</button></a>  
  </div>
@else
    <a href="/compod/compod/server.php/addPodcast"><button type="button" class="btn btn-primary">Add a podcast</button></a><br/><br/>
@endif


<ul>
    @foreach($podcasts as $podcast)
        <li class="list-group-item" style="min-height:84px;">
            <div class="col-md-1">
                <a href="/compod/compod/server.php/podcast/{{$podcast->id}}">
                    <img class="media-object" src="../public/img/podcastlogos/{{ $podcast->iconFile }}" alt="Podcast icon" width="64" height="64">
                </a>
            </div>
            <div>
                @if ($own == 0)
                    <span class="pull-right">
                        @if (!$podcast->creator)
                            @if ($podcast->isSubscribed)
                                <a href="/compod/compod/server.php/unsubscribe/{{$podcast->id}}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button></a>
                            @else
                                <a href="/compod/compod/server.php/subscribe/{{$podcast->id}}"><button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></button></a>
                            @endif
                        @else
                            <p class="text-info">creator</p>
                        @endif
                    </span>
                @endif
                <a href="/compod/compod/server.php/podcast/{{$podcast->id}}"><b>{{$podcast->name}}</b></a><br/>
                <em>{{$podcast->description}}</em>
            </div>
        </li>    
    @endforeach
</ul>
@stop
@extends('layouts.master')

@section('title')
@parent
- Podcast Overview
@stop

@section('content')

@if ($search != "")
<h1>Showing podcasts for {{$search}}</h1>
@else
<h1>Showing {{$type}} podcasts</h1>
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

    <?php
        if (strpos("$_SERVER[REQUEST_URI]",'user') === false)
        {
            echo
            '<div class="container">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Sort
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="/compod/compod/server.php/podcastoverview"><div class="glyphicon glyphicon-sort-by-order"></div> All</a></li>
                        <li><a href="/compod/compod/server.php/abcpodcastoverview"><div class="glyphicon glyphicon-sort-by-alphabet"></div> Abcdef...</a></li>
                        <li><a href="/compod/compod/server.php/zyxpodcastoverview"><div class="glyphicon glyphicon-sort-by-alphabet-alt"></div>  Zyxwvu...</a></li>
                    </ul>
                </div>
            </div>'
            ;
        }
    ?>

<ul>
    @foreach($podcasts as $podcast)
        <li class="list-group-item" style="min-height:84px; margin-top:10px;">
            <div class="col-md-1">
                <a href="/compod/compod/server.php/podcast/{{$podcast->podcast_id}}">
                    <img class="media-object" src="../public/img/podcastlogos/{{ $podcast->iconFile }}" alt="Podcast icon" width="64" height="64">
                </a>
            </div>
            <div>
                @if (strpos($type,Auth::user()->username) === FALSE)
                    <span class="pull-right">
                        @if (!$podcast->creator)
                            @if ($podcast->isSubscribed())
                                <a href="/compod/compod/server.php/unsubscribe/{{$podcast->podcast_id}}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button></a>
                            @else
                                <a href="/compod/compod/server.php/subscribe/{{$podcast->podcast_id}}"><button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></button></a>
                            @endif
                        @else
                            <p class="text-info">creator</p>
                        @endif
                    </span>
                @endif
                <a href="/compod/compod/server.php/podcast/{{$podcast->podcast_id}}"><b>{{$podcast->name}}</b></a><br/>
                <em>{{$podcast->description}}</em>
            </div>
        </li>    
    @endforeach
</ul>
@stop
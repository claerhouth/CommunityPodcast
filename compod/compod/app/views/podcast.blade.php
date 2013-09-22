@extends('layouts.master')

@section('title')
@parent
- Podcast page
@stop

@section('content')

<h1>{{$podcast->name}}</h1>
<div><em>{{$podcast->description}}</em></div>
<hr>
@if (sizeof($episodes) == 0)

<div class="row">
  <div class="col-md-12">It appears there currently aren't any episodes for this podcast.</div>
</div>
<div class="row">
  <div class="col-md-12">
          Why don't you start things up and
          <a href="/compod/compod/server.php/addEpisode/{{$podcast->id}}"><button type="button" class="btn btn-primary btn-xs">Upload an episode</button></a>  
  </div>
</div>

@else
<a href="/compod/compod/server.php/addEpisode/{{$podcast->id}}"><button type="button" class="btn btn-primary">Upload an episode</button></a>  
<div class="col-md-8">                        
          <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Available episodes</div>
   
              <!-- Table -->
              <table class="table">
                  <thead>
                      <tr>
                          <th>Date</th>
                          <th>Episode Title</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($episodes as $episode)
                        <tr>
                          <td>{{$episode->publishdate}}</td>
                          <td><a href="/compod/compod/server.php/episode/{{$episode->id}}">{{$episode->title}}</a></td>
                        </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
@endif

@stop
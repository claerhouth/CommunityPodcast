@extends('layouts.master')

@section('title')
@parent
- Podcast page
@stop

@section('content')

<div class="well">
  <div class="media">
      <div class="col-md-1">
        <img class="media-object" src="../../public/img/podcastlogos/{{ $podcast->iconFile }}" alt="User avatar" width="64" height="64">
      </div>
      <div class="media-body">
        <h3 class="media-heading">{{ $podcast->name }}</h3>
        <em>{{$podcast->description}}</em>
      </div>
  </div>
</div>

<div class="col-md-2">                        
    <div class="panel panel-default">
        <div class="panel-heading">Used skills</div>
            <ul class="list-group">
                {{ Form::open(array('action' => 'PodcastController@saveSkills')) }}
                    @foreach($skills as $skill)
                        <li class="list-group-item">
                            {{ Form::checkbox($skill->skill, $skill->user_skill_id, $skill->use_skill) }} {{$skill->skill}}
                        </li>
                    @endforeach
                    <li class="list-group-item">
                      {{ Form::submit('Save', array('class' => 'btn btn-default btn-xs')) }}
                    </li>
                    {{ Form::hidden('podcastId',$podcast->id)}}
                  {{ Form::close() }}
            </ul>
    </div>
</div>

<div class="col-md-8">

@if (sizeof($episodes) == 0)

  <div>It appears there currently aren't any episodes for this podcast.</div>
  <div>
          Why don't you start things up and
          <a href="/compod/compod/server.php/addEpisode/{{$podcast->id}}"><button type="button" class="btn btn-primary btn-xs">Upload an episode</button></a>  
  </div>
</div>

@else

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
<div class="col-md-2">
  <a href="/compod/compod/server.php/addEpisode/{{$podcast->id}}"><button type="button" class="btn btn-primary">Upload an episode</button></a>  
</div>
@endif

@stop
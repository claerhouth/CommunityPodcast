@extends('layouts.master')

@section('title')
@parent
- {{ Auth::user()->username }}
@stop

@section('content')
<ol class="breadcrumb">
<li><a href="/compod/compod/server.php">Home</a></li>
<li class="active">{{ Auth::user()->username }}</li>
</ol>

  <div class="well">
    <div class="media">
        <div class="col-md-1">
          <img class="media-object" src="../public/img/avatars/{{ Auth::user()->avatarFile }}" alt="User avatar">
        </div>
        <div class="media-body">
          <h4 class="media-heading">{{ Auth::user()->username }}</h4>
          <em>~ {{ Auth::user()->tagline }}</em>
        </div>
    </div>
  </div>
  
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
                          <th>Podcast</th>
                          <th>Creator</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($episodes as $episode)
                        <tr>
                          <td>{{$episode->episode_date}}</td>
                          <td>{{$episode->episode_title}}</td>
                          <td>{{$episode->podcast_name}}</td>
                          <td>
                            @if ($episode->episode_isCreator == 1)
                              Yes
                            @else
                              No
                            @endif
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      
      <div class="col-md-2">                        
          <div class="panel panel-default">
              <div class="panel-heading">Subscribed podcasts</div>
                  <ul class="list-group">
                      @foreach($podcasts as $podcast)
                          <li class="list-group-item">
                              <span class="badge">{{$podcast->episode_count}}</span>
                                @if ($podcast->podcast_isCreator == 1)
                                  <b>
                                @endif
                              <a href="#">{{$podcast->name}}</a>
                                  @if ($podcast->podcast_isCreator == 1)
                                   </b>
                                  @endif
                          </li>
                      @endforeach
                  </ul>
          </div>
      </div>
      
      <div class="col-md-2">                        
          <div class="panel panel-default">
              <div class="panel-heading">Mastered skills</div>
                  <ul class="list-group">
                      @foreach($skills as $skill)
                          <li class="list-group-item">
                              <a href="#">{{$skill->skill}}</a>
                          </li>
                      @endforeach
                  </ul>
          </div>
      </div>
@stop
    
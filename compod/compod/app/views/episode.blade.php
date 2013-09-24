@extends('layouts.master')

@section('title')
@parent
 - {{$episode->title}}
@stop

@section('scripts')
  $(document).ready(function(){
      $("#jquery_jplayer_1").jPlayer({
        ready: function () {
          $(this).jPlayer("setMedia", {
            mp3: "../../public/mp3/{{$episode->file}}"
          });
        },
        swfPath: "/js",
        supplied: "mp3"
      });
  });
@stop

@section('content')
<div class="row">
    <h2>{{$episode->title}}</h2>
    <div><em>{{$episode->publishdate}} by
        @foreach($creators as $creator)
            - {{$creator->username}}
        @endforeach
    </em></div><br/>
    <div>{{$episode->description}}</div><br/>
</div>
<div class="row">
    <div class="col-md-4">
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
        <div id="jp_container_1" class="jp-audio">
            <div class="jp-type-single">
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls">
                        <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                    </ul>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                    <div class="jp-time-holder">
                        <div class="jp-current-time"></div>
                        <div class="jp-duration"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
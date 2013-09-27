@extends('layouts.master')

@section('title')
@parent
- Add Podcast
@stop

@section('content')
<h1>Adding a new episode</h1>
<div>This episode will be added to the <b>{{$podcast->name}}</b> podcast.</div>
<br/>

{{ Form::open(array('action' => 'EpisodeController@insertEpisode', 'files'=> true)) }}
    {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'Title')) }}<br>
    {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control', 'placeholder' => 'Description')) }}<br>
    Audio file : {{ Form::file('file'); }} <em>Only mp3's are supported.</em><br><br>
    Icon : {{ Form::file('image'); }} <em>Best result with 64x64 pictures.</em><br><br>
    {{ Form::hidden('podcastId',$podcast->id)}}
    {{ Form::submit('Upload episode', array('class' => 'btn btn-default')) }}
{{ Form::close() }}

@stop
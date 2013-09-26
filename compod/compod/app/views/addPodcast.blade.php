@extends('layouts.master')

@section('title')
@parent
- Add Podcast
@stop

@section('content')
<h1>Adding a new podcast</h1>

{{ Form::open(array('action' => 'PodcastController@insertPodcast', 'files'=> true)) }}
    {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}<br>
    {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control', 'placeholder' => 'Description')) }}<br>
    {{ Form::file('image'); }} <em>Best result with 64x64 pictures.</em><br><br>
    {{ Form::label('Invite only')}}  {{ Form::checkbox('inviteonly', 'no', false) }}<br>
    {{ Form::submit('Add podcast', array('class' => 'btn btn-default')) }}
{{ Form::close() }}
@stop
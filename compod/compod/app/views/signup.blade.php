@extends('layouts.master')

@section('title')
@parent
- Login
@stop

@section('content')

{{ Form::open(array('action' => 'UserController@insertUser', 'files'=> true)) }}
    {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Username')) }}<br>
    {{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'E-mail address')) }}<br>
    {{ Form::text('tagline', Input::old('tagline'), array('class' => 'form-control', 'placeholder' => 'Tagline (e.g. Carp&#233; Diem!)')) }}<br>
    {{ Form::file('image'); }} <em>Best result with 64x64 pictures.</em><br><br>
    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}<br>
    {{ Form::password('confirm', array('class' => 'form-control', 'placeholder' => 'Repeat password')) }}<br>
     
    {{ Form::submit('Signup', array('class' => 'btn btn-default')) }}
    <a href="/compod/compod/server.php/login">{{ Form::submit('Cancel', array('class' => 'btn btn-default')) }}</a>
{{ Form::close() }}

@stop
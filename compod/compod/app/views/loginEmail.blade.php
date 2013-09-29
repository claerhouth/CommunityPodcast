@extends('layouts.master')

@section('title')
@parent
- Login
@stop

@section('content')
            
{{ Form::open(array('action' => 'UserController@loginFacebookEmail')) }}

    <div class="row">
	<div class="col-md-6 col-md-offset-3">
	    <h1>Hi there!</h1>
	    <h2>Looks like you're new here. We couldn't retrieve your e-mail from facebook.</h2>
	    <p>Please provide your e-mail adress:</p>
	    {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Email')) }}<br>
	    {{ Form::submit('Complete the registration process', array('class' => 'btn btn-default')) }}
	</div>
    </div>

    
{{ Form::close() }}

{{ Form::open(array('action' => 'UserController@loginFacebook')) }}

    <div class="row">
	<div class="col-md-6 col-md-offset-3">
		       {{ Form::submit('Login using Facebook', array('class' => 'btn btn-default')) }}
		       		       
		       <!-- check for login errors flash var -->
			@if (Session::has('login_errors'))
			    <div class="alert alert-danger">Username or password incorrect.</div>
			@endif
	</div>
    </div>

    
{{ Form::close() }}

@stop
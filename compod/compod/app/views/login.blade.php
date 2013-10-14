@extends('layouts.master')

@section('title')
@parent
- Login
@stop

@section('content')
            
{{ Form::open(array('action' => 'UserController@loginUser')) }}

    <div class="row">
	<div class="col-md-6 col-md-offset-3">
			@if (Session::has('login_errors'))
				<div class="alert alert-danger">Username or password incorrect.</div>
			@endif
			{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Username')) }}<br>
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}<br>
		        {{ Form::submit('Login', array('class' => 'btn btn-default')) }}
			<em> Or </em>
		 	{{ Form::submit('Login using Facebook', array('name' => 'LoginFacebook','class' => 'btn btn-default')) }}		       
			<!-- check for login errors flash var -->

			<br/>
		       <em><a href="/compod/compod/server.php/signup">Or create an account here</a></em><br><br>
	</div>
    </div>

    
{{ Form::close() }}

@stop
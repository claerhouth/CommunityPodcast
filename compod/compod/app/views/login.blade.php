@extends('layouts.master')

@section('title')
@parent
- Login
@stop

@section('content')
            
{{ Form::open() }}

    <div class="row">
	<div class="col-md-6 col-md-offset-3">
			{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Username')) }}<br>
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}<br>
			
		    
		
		       {{ Form::submit('Login', array('class' => 'btn btn-default')) }}
		       <em><a href="/compod/compod/server.php/signup">Or create an account here</a></em><br><br>
		       
		       <!-- check for login errors flash var -->
			@if (Session::has('login_errors'))
			    <div class="alert alert-danger">Username or password incorrect.</div>
			@endif
	</div>
    </div>

    
{{ Form::close() }}

@stop
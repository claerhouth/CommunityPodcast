@extends('layouts.master')

@section('title')
@parent
- Login
@stop

@section('content')
            
{{ Form::open() }}

    <!-- check for login errors flash var -->
    @if (Session::has('login_errors'))
        <span class="error">Username or password incorrect.</span>
    @endif
    
    <div class="row">
	<div class="col-md-6 col-md-offset-3">
			{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Login')) }}<br>
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}<br>
			
		    
		
		    <div class="btn-group">
		       {{ Form::submit('Login', array('class' => 'btn btn-default')) }}
		   </div>
	</div>
    </div>

    
{{ Form::close() }}

@stop
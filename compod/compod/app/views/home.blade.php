@extends('layouts.master')

@section('title')
@parent
- Home
@stop

@section('content')
<h1>Welcome {{ Auth::user()->username }}</h1>
<p>You have reached your home.</p>
<p>You can logout using the account menu.</p>
@stop
    
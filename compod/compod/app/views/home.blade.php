@extends('layouts.master')

@section('title')
@parent
- Home
@stop

@section('content')
<h1>Welcome {{ Auth::user()->username }}</h1>
<p>You have reached your home.</p>
<p>Please try out ALL the buttons and don't forget the Account menu on the topright.</p>
<p>Have fun!</p>
@stop
    
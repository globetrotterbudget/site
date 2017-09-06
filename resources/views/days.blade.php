@extends('layouts.master')

@section('title')
<title>Days of Travel</title>
@stop

@section('content')
<h2>How many days would you like to visit for?</h2>

<form method="GET" action="{{action ('PageController@days')}}">
	<input type="text" name="days">
	<button type="submit">Submit</button>
</form>

@stop
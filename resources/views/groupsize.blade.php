@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')
<h2>How many will you be traveling with?</h2>
<form method="GET" action="{{ action('PageController@groupsize') }}">
	<input type="text" name="groupsize">
	<button type="submit">Submit</button>
</form>
@stop
@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')
<h2>How many will you be traveling with?</h2>
<form method="GET" action="{{ action('PageController@accommodations')}}">
	<button type="submit" name="accommodations" value='1'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="accommodations" value='2'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="accommodations" value='3'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="accommodations" value='4'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="accommodations" value='5'><span class="glyphicon glyphicon-star-empty"></span></button>
</form>
@stop


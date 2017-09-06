@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')
<h2>How many will you be traveling with?</h2>
<form method="GET" action="transportation">
	<button type="submit" name="1" value='1'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="2" value='2'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="3" value='3'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="4" value='4'><span class="glyphicon glyphicon-star-empty"></span></button>
	<button type="submit" name="5" value='5'><span class="glyphicon glyphicon-star-empty"></span></button>
</form>
@stop


@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')

<div class="container">
	<div id="wizard" class="col-md-8 parent-container">
		<div id="content">
			<h2>Accommodations</h2>
			<form method="GET" action="{{ action('PageController@accommodations')}}">
				<button type="submit" name="accommodations" value='1'><span class="glyphicon glyphicon-star-empty"></span></button>
				<button type="submit" name="accommodations" value='2'><span class="glyphicon glyphicon-star-empty"></span></button>
				<button type="submit" name="accommodations" value='3'><span class="glyphicon glyphicon-star-empty"></span></button>
				<button type="submit" name="accommodations" value='4'><span class="glyphicon glyphicon-star-empty"></span></button>
				<button type="submit" name="accommodations" value='5'><span class="glyphicon glyphicon-star-empty"></span></button>
			</form>
		</div>
	</div>
	@if(!empty($array)) 
	<div class="col-md-4">
		<div id="sidebar">
		@foreach( $array as $key => $value )
			<p>{{ $key . ':'}}</p>
			<div class="row">
				<h4 class="category">{{ $value }}</h4>
			 	<a class="sidebarEdit" href="">edit</a>
			 </div>
		@endforeach
		</div>
	@endif
	</div>
@stop


@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')

<div class="container">

	<div id="wizard" class="col-md-8 parent-container">
		<div id="content">
			<div class="row">
					<?php $location = $array['location']; ?>
					<div id="locationBox" class="container">
				 		<h4 class="category">{{ $location }}</h4>
					</div>
				</div>
			<h2>How many will you be traveling with?</h2>
			<form method="GET" action="{{ action('PageController@groupsize') }}">
				<input type="text" name="groupsize">
				<button type="submit">Submit</button>
			</form>
		</div>
	</div>
	@if(!empty($array)) 
	<div class="col-md-4">
		<div id="sidebar">
			<?php $location = array_shift($array); ?>
			
			@foreach( $array as $key => $value )
			<p>{{ $key . ':'}}</p>
			<div class="row">
				<h4 class="category">{{ $value }}</h4>
			 	<a class="sidebarEdit" href="/{{ $key }}">edit</a>
			 </div>
		@endforeach
		</div>
	@endif
	</div>
@stop


	

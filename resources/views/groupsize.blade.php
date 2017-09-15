@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')

<?php $location = $array['location']; ?>
<div id=daysBlade class="container">
	<div id="wizard" class="col-md-8 parent-container">
		<div id="locationBox" class="row">
	 		<h4>{{ $location }}</h4>
		</div>
		<div id="content">
		<div id="groupImage" class="row"></div>
			<div id="headline" class="row">
			<h2>How many travelers in your group?</h2>
			<form method="GET" action="{{ action('PageController@groupsize') }}">
				<input type="text" name="groupsize">
				<button type="submit">Submit</button>
			</form>

			</div>
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


	

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
			<h2>Accommodations</h2>

				<span data-star=0 class="star"> &#9734 </span>
			    <span data-star=1 class="star"> &#9734 </span>
			    <span data-star=2 class="star"> &#9734 </span>
			    <span data-star=3 class="star"> &#9734 </span>
			    <span data-star=4 class="star"> &#9734 </span>

			    <p id="ratings"></p>


    			
				<form method="GET" action="{{ action('PageController@accommodations')}}">

					<input type="hidden" name="accommodations" id="accommodations" value="">
					<a href="/groupsize"><input type="button" class="btn btn-default" value="Previous"></a>
        			<button id="accommodationsButton" class="btn btn-default" type="submit">Submit</button>

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



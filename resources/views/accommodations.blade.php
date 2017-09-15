@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')

<?php $location = $array['location']; ?>
<?php $historical = array_pop($array); ?>
<div id="accommodationsBlade" class="container">
	<div id="wizard" class="col-md-8 parent-container">
		<div id="locationBox" class="row">
	 		<h4>{{ $location }}</h4>
		</div>
		<div id="content">
		<div class="row">
		<div id="headline" class="row">
		</div>
		<div class="row">
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
				<div style="margin-top:20px" class="row">
					<div id="runningTotal">
						<p>Historical average cost</p>
						 <h1 style="margin-top:10px; margin-bottom:5px">$ {{ $historical }}</h1>
						<p>per person / day</p>
					</div>
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



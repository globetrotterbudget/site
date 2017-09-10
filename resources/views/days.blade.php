@extends('layouts.master')

@section('title')
<title>Days of Travel</title>
@stop

@section('content')



<div class="container">

	<div id="wizard" class="col-md-8 parent-container">
		<div id="content">
			<h2>How many days would you like to visit for?</h2>
        <form method="GET" action="{{action ('PageController@days')}}">
          <input type="text" name="days">
          <button type="submit">Submit</button>
        </form>
		</div>
	</div>
	@if(!empty($array)) 
	<div class="col-md-4">
		<div id="sidebar">
		<div class="row">
			<?php $location = array_shift($array); ?>
		 	<h4 class="category">{{ $location }}</h4>
		 	<a class="sidebarEdit" href="">edit</a>
		</div>
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
</div>



@stop
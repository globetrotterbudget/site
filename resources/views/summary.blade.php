@extends('layouts.master')

@section('title')
<title>Summary</title>
@stop

@section('content')

<div class="container">
	<div class="col-md-4">
		<div id="sidebar">
			<div class="row">
				<?php $location = array_shift($array); ?>
				<?php $entertainment = array_pop($array); ?>
			 	<h4 class="category">{{ $location }}</h4>
			 	<a class="sidebarEdit" href="/">edit</a>
			</div>

			@foreach( $array as $key => $value )
				<p>{{ $key . ':'}}</p>
				<div class="row">
					<h4 class="category">{{ $value }}</h4>
				 	<a class="sidebarEdit" href="/{{ $key }}">edit</a>
				 </div>
			@endforeach
			<p>Entertainment<br>
					@foreach($entertainment as $thing)
					{!! $thing . ", " !!}
					@endforeach
				</p>
				<a class="sidebarEdit" href="">edit</a>
		</div>
	</div>
	<div id="wizard" class="parent-container">
		<div id="content">
			
        	@if(Auth::check())
        		@if(isset($array['id']))
          		<a href="/update"><input type="button" class="btn btn-default" value="Update intinerary"></a>
          		@else
          		<a href="/save"><input type="button" class="btn btn-default" value="Save this itinerary"></a>
          		@endif
          	@else
          	<form method="GET" action="{{action ('PageController@location')}}">
          		<input type="submit"class="btn btn-default">Start Over</input>
        	</form>
          	<?php session()->put('itinerary', 'yes'); ?> 
          	<a href="/auth/login"><input type="button" value="Save this itinerary" class="btn btn-default"></a>
          	@endif
		</div>
	</div>
</div>

@stop

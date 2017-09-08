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
				<a class="sidebarEdit" href="/entertainment">edit</a>
				
				
				 
		</div>
	</div>
	<div id="wizard" class="parent-container">
		<div id="content">
			
        <form method="GET" action="{{action ('PageController@location')}}">
          	<button type="submit">Add another trip</button>
        </form>
          	<button type="submit">Save this itinerary</button>
		</div>
	</div>
</div>

@stop

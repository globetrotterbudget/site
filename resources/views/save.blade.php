@extends('layouts.master')

@section('title')

@stop

@section('content')

<div class="container">

    <div class="col-md-offset-2 col-md-8 parent-container">
        <div id="save">

        		<form method="POST" action="{{ action('PageController@save') }}">
        		{{ csrf_field() }}
        			<label for="save">Save to New Trip</label>
        			<input type="text" name="trip_name">
        			<button type="submit">Save</button>
					<label for="save">Save to Existing Trip</label>
        			<select name="trip_name"></select>
        			<button type="submit">Save</button>
        		</form>
				<?php $location = array_shift($array); ?>
				<?php $entertainment = array_pop($array); ?>
			 	<h4 class="category">{{ $location }}
			 	<a class="sidebarEdit" href="">edit</a></h4>
			@foreach( $array as $key => $value )
				<p>{{ $key . ':'}}</p>
				
					<h4 class="category">{{ $value }}
				 	<a class="sidebarEdit" href="">edit</a></h4>
			@endforeach
			<p>Entertainment<br>
					@foreach($entertainment as $thing)
					{!! $thing . ", " !!}
					@endforeach
				
				<a class="sidebarEdit" href="">edit</a></p>
		</div>
	</div>
</div>
@stop
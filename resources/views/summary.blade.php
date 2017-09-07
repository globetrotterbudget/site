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
	</div>
</div>

@stop
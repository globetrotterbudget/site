@extends('layouts.master')

@section('title')
<title>Number in Group</title>
@stop

@section('content')

<?php $location = $array['location']; ?>
<div id=daysBlade class="container">
	<div class='row'>
		<div id="wizard" class="col-md-8 parent-container">
			<div id="locationBox" class="row">
		 		<h4>{{ $location }}</h4>
			</div>
			<div id="content">
				<div id="groupImage" class="row"></div>
					<div id="headline" class="row">
						<h2>How many travelers in your group?</h2>
						<form method="GET" action="{{ action('PageController@groupsize') }}">
							<div class="col-md-6 col-md-offset-3">
								<div class='input-group'>
									<input type="text" name="groupsize" class='form-control'>
									<span class='input-group-btn'>
										<button type="submit" class='btn btn-default'>Submit</button>
									</span>
								</div>
							</div>
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
</div>
@stop


	

@extends('layouts.master')

@section('title')
<title>Days of Travel</title>
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
				<div id="daysImage" class="row"></div>
					<div id="headline" class="row">
						<h2>How many days would you like to visit for?</h2>
		    	    	<form method="GET" action="{{action ('PageController@days')}}">
  							<div class="col-md-6 col-md-offset-3">
   								<div class='input-group'>
		    	    	  			<input type="text" name="days" class='form-control' required>
		    	    	  			<input type="hidden" name="location" value="{{ $array['location']}}">
		        	 				@if(isset($array['id']))
		        	
		        	 				<input type="hidden" name="id" value="{{ $array['id'] }}">
		        	  				<input type="hidden" name="location" value="{{ $array['location']}}">
		
		        	  				@endif
		
    	    						<span class='input-group-btn'>
		        	  					<button type="submit" class='btn btn-default'>Submit</button>
    	    						</span>
    	    					</div>
    	    				</div>		
		        		</form>
    	    		</div><!-- /.col-lg-6 -->
				</div>
    	    				
		</div>
		@if(!empty($array)) 
		<div class="col-md-4">
			<div id="sidebar">
			
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
</div>



@stop
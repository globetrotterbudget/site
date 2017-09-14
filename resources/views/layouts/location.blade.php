@extends('layouts.master')

@section('title')
<title>Location of Travel</title>
@stop

@section('content')

<div id="header">	
	<div id="welcome" class="col-md-offset-1 col-md-9">
		<div id="banner">Plan your vacation budget</div>
   		<form method="GET" action="{{action ('PageController@location')}}">
   			<div class="row">
  				<div class="col-lg-6 col-lg-offset-3">
   					<div class='input-group'>
        				<input type="text" name="location" class='form-control' placeholder=' e.g. City, State/Country' required>
        			<span class='input-group-btn'>
        				<button type="submit" class='btn btn-success'>Go</button>
        			</span>
        			</div>
        		</div><!-- /.col-lg-6 -->
        	</div><!-- /.row -->
      	</form>	
    </div>    
</div>
<div class="container">
	<div class="row">
		<h2>Featured Locations</h2>
	</div>
	<div class="col-md-offset-1 col-md-10">
		<a href="{{ action('PageController@paris_feature') }}">
			<div id="feature1" class="feature">
				<h2>Paris</h2>
			</div>
		</a>
		<a href="{{ action('PageController@tel_aviv_feature') }}">
		<div id="feature2" class="feature">
			<h2>Tel Aviv</h2>
		</div>
		</a>
		<a href="{{ action('PageController@tokyo_feature') }}">
		<div id="feature3" class="feature">
			<h2>Tokyo</h2>
		</div>
		</a>		
	</div>
</div>



@stop
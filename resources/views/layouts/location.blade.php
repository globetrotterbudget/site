@extends('layouts.master')

@section('title')
<title>Location of Travel</title>
@stop

@section('content')

<div id="header">	
	<div id="welcome" class="col-md-offset-1 col-md-9">
		<div id="banner">Plan your vacation budget</div>
   		<form method="GET" action="{{action ('PageController@location')}}">
        	<input id="search" type="text" name="location" placeholder='e.g. City, Country'>
        	<button type="submit">Go</button>
      	</form>
    </div>    
</div>
<div class="container">
	<div class="row">
		<h2>Featured Locations</h2>
	</div>
	<div class="col-md-offset-1 col-md-10">
		<div id="feature1" class="feature">
			<h2>Paris</h2>
		</div>
		<div id="feature2" class="feature">
			<h2>Tel Aviv</h2>
		</div>
		<div id="feature3" class="feature">
			<h2>Tokyo</h2>
		</div>		
	</div>
</div>



@stop
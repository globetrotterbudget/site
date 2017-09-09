@extends('layouts.master')

@section('title')
<title>Trips</title>
@stop

@section('content')

<div class="container">

    <div class="col-md-offset-2 col-md-8 parent-container">

    	<h2>My Trips</h2>

    	<?php foreach($tripNames as $trip)
		{
			echo "<div class=\"panel panel-default\">"
			. "<div class=\"panel-body\">" .
			"<a href=\"/trips/$trip->trip_name\">"  . $trip->trip_name 
			."</a>" . "</div>" . "</div>";
		
		}?>

    </div>

 </div>
@stop
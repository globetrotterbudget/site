@extends('layouts.master')

@section('title')
<title>Trip Detail</title>
@stop

@section('content')

<div class="container">

	<div id="tripname" class="row">
		<div class="col-md-3">
			<h2>{{ $trips[0]->trip_name }}</h2>
		</div>
		<div style="text-align:right" class="col-md-offset-6 col-md-3">
			<h2>$95/day</h2>
		</div>
		<div class="col-md-12"><hr></div>
	</div>
    
    @foreach($trips as $trip)
    
    <div class="row">
    	<div class="col-md-12">
    		<h3>{{$trip->location}}</h3>
    	</div>
    	<div class="col-md-3">
    	<p>SELECTED:</p>
    	<h5>Travelers: {{$trip->groupsize}}</h5>
    		<h5>Days: {{ $trip->days }}</h5>
    		<h5>Accommodations:</h5>
    		<h5>{{ $trip->accommodations }} star hotel</h5>
    		<h5>Transportation:</h5>
    		<h5>{{ $trip->transportation }}</h5>
    		<h5>Food: {{ $trip->food }}</h5>
    		<h5>Entertainment extras:</h5>


    		<?php $newarray = $trip->options;
    			foreach($newarray as $option)
    			{
    				echo '<h5>' . $option['description'] . ': ';
    				echo '$ ' . $option['price'] . '</h5>';
    			} ?>


    		

    		
    	</div>
    		
    		
    	<div class="col-md-4">
    	<p>SELECTED:</p>
    		<h5>Accommodations:</h5>
    		<h5>${{ $trip->cost->accom_day_cost }} per day</h5>
    		<h5>${{ $trip->cost->accom_cost }} per day</h5>
    		<h5>Meals:</h5>
    		<h5>${{ $trip->cost->avg_food_day_cost }} per day</h5>
    		<h5>${{ $trip->cost->avg_food_cost }} group per day</h5>
    		<h5>Transportation:</h5>
    		<h5>${{ $trip->cost->avg_trans_day_cost }} per day</h5>
    		<h5>${{ $trip->cost->avg_trans_cost }} group per day</h5>
    	</div>
    	<div class="col-md-2">
    		<h1>${{ $trip->daily }}</h1>
    		<p>per day</p>
    	</div>
    	<div class="col-md-3">
    		<a href="/trips/{{ $trip->id }}/edit" class="btn btn-default">Edit</a>
    		<a href="#" class="btn btn-default">Delete {{ $trip->id }}</a>
    		

    	</div>
    	<div class="col-md-12"><hr></div>
    </div>

    @endforeach

    <div class="row">
    	<div class="col-md-offset-5 col-md-2">
    		<a href="/trips" class="btn btn-default">Back to my trips</a>
    	</div>
    	<div class="col-md-12"><br><br></div>
    </div>
    	
	</div>

</div>

@stop
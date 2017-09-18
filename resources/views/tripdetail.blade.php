

@extends('layouts.master')

@section('title')
<title>Trip Detail</title>
@stop

@section('content')

<div class="container">

	<div id="tripname" class="row">
		<div class="col-md-3">
			<h2 class="tripName">{{ $trips[0]->trip_name }}</h2>
		</div>
		<div style="text-align:right" class="col-md-offset-6 col-md-3">
			<h2><span style="font-size:18px; font-weight: 400; color:#dbdbdb">trip total: </span><span style="color:#99d7c2">$</span><span id="tripTotal"></span></h2>
		</div>
		<div class="col-md-12"><hr></div>
	</div>
    
    @foreach($trips as $trip)
    
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="tripLocation">{{$trip->location}}</h2>
    	</div>
    	<div class="col-md-4">
        	<p class="costCategory">SELECTED:</p>

        	<h5 class="costItem"><span class="indivCost">Travelers:</span> {{$trip->groupsize}}</h5>
    		<h5 class="dayNumber costItem" data-tripdays="{{ $trip->days }}"><span class="indivCost">Days:</span> {{ $trip->days }}</h5>
    		<h5 class="costItem"><span class="indivCost">Accommodations:</span></h5>
            <div class="starNumber" style="display:none">{{ $trip->accommodations }}</div>
    		<h5 class="starDisplay"></h5>
            <h5 class="costItem"><span class="indivCost">Transportation:</span></h5>
            <h5 class="costItem">{{ $trip->transportation }}</h5>
    		<h5 class="costItem"><span class="indivCost">Food / Drink:</span></h5>
            <div class="dollarNumber" style="display:none">{{ $trip->food }}</div>
    		<h5 class="dollarDisplay"></h5>
    		<h5 class="costItem"><span class="indivCost">Entertainment extras:</span></h5>

        		<?php $newarray = $trip->options;
        			foreach($newarray as $option)
        			{
        				echo '<h5 class="costItem">' . $option['description'] . ': ';
        				echo '$ ' . $option['price'] . '</h5>';
        			} ?>
    		
    	</div>
    		
    	
    	<div class="col-md-4">
    	<p class="costCategory">COSTS:</p>
    		<h5 class="costItem"><span class="indivCost">Accommodations:</span></h5>
    		<h5 class="costItem">${{ number_format(($trip->cost->accom_day_cost),2,'.','') }} per day</h5>
    		<h5 class="costItem">${{ number_format(($trip->cost->accom_cost),2,'.','') }} trip total</h5><br>
    		<h5 class="costItem"><span class="indivCost">Meals:</span></h5>
    		<h5 class="costItem">${{ number_format(($trip->cost->avg_food_day_cost),2,'.','') }} per day</h5>
    		<h5 class="costItem">${{ number_format(($trip->cost->avg_food_cost),2,'.','') }} trip total</h5><br>
    		<h5 class="costItem"><span class="indivCost">Transportation:</span></h5>
    		<h5 class="costItem">${{ number_format(($trip->cost->avg_trans_day_cost),2,'.','') }} per day</h5>
    		<h5 class="costItem">${{ number_format(($trip->cost->avg_trans_cost),2,'.','') }} trip total</h5>
    	</div>
    	<div class="col-md-3 dailyColumn">
    		<h1 class="dailyNumber" data-daily="{{$trip->daily}}">${{ $trip->daily }}</h1>
    		<p>per day</p>
    		<button class="gtButton3"><a href="/trips/{{ $trip->id }}/edit">Edit</a></button>
    	<form method="POST" action="{{ action ('PageController@destroy', $trip->id) }}"
    			onsubmit="return confirm('Delete your trip to {{ $trip->location}}?');">
    		{{ csrf_field() }}
    		<button class="gtButton3"><input type="submit" value="Delete"></button>
    	</form>

    	</div>
    	<div class="col-md-12"><hr></div>
    </div>

    @endforeach

    <div class="row">
    	<div class="col-md-12" style="text-align:center">
    		<button class="gtButton2"><a href="/trips">Back to trips</a></button>
    		<button class="gtButton"><a href="{{ action('PageController@newcity') }}">Add city</a></button>
    	</div>
    	<div class="col-md-12"><br><br></div>
    </div>
    	
	</div>

</div>

@stop
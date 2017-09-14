@extends('layouts.master')

@section('title')

@stop

@section('content')

<?php $entertainment = session()->get('entertainment'); ?>

<div id="summaryBlade" class="container">

 	<div class="row">
    	<div class="col-md-12">
    		<h3>{{ $array['location'] }}</h3>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-3">
    		<p>SELECTED:</p>
    		<h5>Travelers: {{ $array['groupsize'] }}</h5>
    		<h5>Days: {{ $array['days'] }}</h5>
    		<h5>Accommodations:</h5>
    		<h5>{{ $array['accommodations']}} star hotel</h5>
    		<h5>Transportation:</h5>
    		<h5>{{ $array['transportation'] }}</h5>
    		<h5>Food: {{ $array['food'] }}</h5>
    		<h5>Entertainment extras</h5>

    		@if(isset($entertainment) && is_array($entertainment))
				@foreach($entertainment as $things)

					<h5>{{ $things['description'] . ': '}}
					{{ $things['price'] . ': '}}<br></h5>
					<?php   $entTotal = 0;
							$entTotal += (int)($things['price']); ?>

				@endforeach
			@else
			
			<h5>none available</h5>
			@endif
    	</div>
    	<div class="col-md-4">
    		<p>COSTS:</p>
    		<h5>Accommodations:</h5>
    		<h5>${{ session()->get('average_accommodation_cost_per_day') }} per day</h5>
    		<h5>${{ session()->get('average_accommodation_cost') }} per day</h5>
    		<h5>Meals:</h5>
    		<h5>${{ session()->get('average_food_cost_per_day') }} per day</h5>
    		<h5>${{ session()->get('average_food_cost') }} group per day</h5>
    		<h5>Transportation:</h5>
    		<h5>${{ session()->get('average_transportation_cost_per_day') }} per day</h5>
    		<h5>${{ session()->get('average_transportation_cost') }} group per day</h5>

    	</div>
    	<div class="col-md-2">
<?php
    	$acc = (float)session()->get('average_accommodation_cost_per_day');
    	$food = (float)session()->get('average_food_cost_per_day');
    	$trans = (float)session()->get('average_transportation_cost_per_day');
    	$extra = isset($entTotal) ? (float)$entTotal : 0;
    	$days = (float)$array['days'];
    	$daily = ($acc + $food + $trans + ($extra/$days));
    	$group = (float)(session()->get('groupsize'));
    	$grouply = ($daily * $group);
    	?>

    		<h1>${{ number_format($daily,2,'.','') }}</h1>
    		<p>per day</p>
    		<h5>${{ number_format($grouply,2,'.','') }} group per day</h5>

    	</div>
    	<div class="col-md-3">

    		

    	</div>

    <div class="col-md-12 parent-container">
        <div id="save">
        		<form method="POST" action="{{ action('PageController@store') }}">
        		{{ csrf_field() }}
        			<label for="save">Save to New Trip</label>
        			<input type="text" name="trip_name">
        			<button type="submit">Save</button>
        		</form>
        		<form method="POST" action="{{ action('PageController@store') }}">
        		{{ csrf_field() }}
					<label for="save">Save to Existing Trip</label>
        			<select name="trip_name">
        		
					<?php foreach($tripNames as $trip)
					{
						echo "<option>" . $trip->trip_name . "</option>";
					}?>
					</select>
        			<button type="submit">Save</button>
				
		</div>
	</div>
</div>
@stop
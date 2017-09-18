@extends('layouts.master')

@section('title')

@stop

@section('content')
<?php $entertainment = session()->get('entertainment'); ?>

<div id="summaryBlade" class="container">

 	<div class="row">
    	<div class="col-md-12">
    		<h3 class="tripLocation">{{ $array['location'] }}</h3>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-4">
    		<p class="costCategory">SELECTED:</p>
	        <h5 class="costItem"><span class="indivCost">Travelers:</span> {{ $array['groupsize'] }}</h5>
	        <h5 class="dayNumber costItem" data-tripdays="{{ $array['days'] }}"><span class="indivCost">Days:</span> {{ $array['days'] }}</h5>
	        <h5 class="costItem"><span class="indivCost">Accommodations:</span></h5>
	        <div class="starNumber" style="display:none">{{ $array['accommodations'] }}</div>
	        <h5 class="starDisplay"></h5>
	        <h5 class="costItem"><span class="indivCost">Transportation:</span></h5>
	        <h5 class="costItem">{{ $array['transportation'] }}</h5>
	        <h5 class="costItem"><span class="indivCost">Food / Drink:</span></h5>
	        <div class="dollarNumber" style="display:none">{{ $array['food'] }}</div>
	        <h5 class="dollarDisplay"></h5>
	        <h5 class="costItem"><span class="indivCost">Entertainment </extras:</h5>

    		@if(isset($entertainment) && is_array($entertainment))
				@foreach($entertainment as $things)

					<h5 class="costItem">{{ $things['description'] . ': '}}
					{{ $things['price'] . ': '}}<br></h5>
					<?php   $entTotal = 0;
							$entTotal += (int)($things['price']); ?>

				@endforeach
			@else
			
			<h5>none available</h5>
			@endif
    	</div>
    	<div class="col-md-4">
    		<p class="costCategory">COSTS:</p>
    		<h5 class="costItem"><span class="indivCost">Accommodations:</span></h5>
    		<h5 class="costItem">${{ session()->get('average_accommodation_cost_per_day') }} per day</h5>
    		<h5 class="costItem">${{ session()->get('average_accommodation_cost') }} trip total</h5><br>
    		<h5 class="costItem"><span class="indivCost">Meals:</span></h5>
    		<h5 class="costItem">${{ session()->get('average_food_cost_per_day') }} per day</h5>
    		<h5 class="costItem">${{ session()->get('average_food_cost') }} trip total</h5><br>
    		<h5 class="costItem"><span class="indivCost">Transportation:</span></h5>
    		<h5 class="costItem">${{ session()->get('average_transportation_cost_per_day') }} per day</h5>
    		<h5 class="costItem">${{ session()->get('average_transportation_cost') }} trip total</h5>

    	</div>
    	<div class="col-md-3 dailyColumn">
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
    		<h1 style="display:none" class="dailyNumber" data-daily="{{$daily}}">${{ $daily }}</h1>
    		<h1 class="dailyNumber" style="display:inline-block">${{ number_format($daily,2,'.','') }} <p style="display:inline-block; font-size:16px"><span>/ day</span></p></h1>
            
            <h5 class="costItem"><span class="indivCost">${{ number_format($grouply,2,'.','') }}</span> group per day</h5>
    	</div><br>


    <div class="col-md-12 parent-container">
        <div id="save"><br>
            <div class="col-md-4" style="padding:0px">
        		<form style="display:inline-block" method="POST" action="{{ action('PageController@store') }}">
        		{{ csrf_field() }}
        			<label class="gtSave" for="save">Save to New Trip</label>
        			<input class="gtInput" type="text" name="trip_name" placeholder="Enter a trip name" required>
        			<button class="gtSaveButton" type="submit">Save</button>
        		</form>
            </div>
            <div class="col-md-4" >
        		<form style="display:inline-block" method="POST" action="{{ action('PageController@store') }}">
        		{{ csrf_field() }}
					<label class="gtSave"for="save">Save to Existing Trip</label>
        			<select class="gtInput" name="trip_name">
        		
					<?php foreach($tripNames as $trip)
					{
						echo "<option>" . $trip->trip_name . "</option>";
					}?>
					</select>
        			<button class="gtSaveButton" type="submit">Save</button>
			     </form>
            </div>
		</div>
	</div>
</div>
@stop
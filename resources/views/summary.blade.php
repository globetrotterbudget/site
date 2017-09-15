
			<?php 	
					

					if (is_string(session()->get('entertainment')) &&
					   !empty(session()->get('entertainment')) )
					{

					$entString = session()->get('entertainment');

					session()->forget('entertainment');
					$substring = substr($entString, 1, -1);

			

					$patterns = array();

					$patterns[0] = '/"/';
					$patterns[1] ='/description:/';
					$patterns[2] = '/price:/';
					$patterns[3] = '/{/';
					$patterns[4] = '/}/';

					$replacements = array();
					$replacements[4] = '';
					$replacements[3] = '';
					$replacements[2] = '';
					$replacements[1] = '';
					$replacements[0] = '';

					$newString = preg_replace($patterns, $replacements, $substring);
					$saveEntertainment = explode(',', $newString);

					$saveEntertainment = array_chunk($saveEntertainment, 2);

					foreach($saveEntertainment as $arrays) 
					{
						$ent['description'] = $arrays[0];
						$ent['price'] = $arrays[1];

						$entertainment[] = $ent;
					}

                    session()->put('entertainment', $entertainment);
					}	
						
					  ?>
						
@extends('layouts.master')
<?php var_dump($array); ?>
@section('title')
<title>Summary</title>
@stop

@section('content')

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
    		<h5>${{ session()->get('average_accommodation_cost') }} trip total</h5>
    		<h5>Meals:</h5>
    		<h5>${{ session()->get('average_food_cost_per_day') }} per day</h5>
    		<h5>${{ session()->get('average_food_cost') }} trip total</h5>
    		<h5>Transportation:</h5>
    		<h5>${{ session()->get('average_transportation_cost_per_day') }} per day</h5>
    		<h5>${{ session()->get('average_transportation_cost') }} trip total</h5>

    	</div>
    	<div class="col-md-2">
<?php
    	$acc = (float)session()->get('average_accommodation_cost_per_day');
    	$food = (float)session()->get('average_food_cost_per_day');
    	$trans = (float)session()->get('average_transportation_cost_per_day');
    	$extra = isset($entTotal) ? (float)$entTotal : 0;
    	$days = (float)$array['days'];
    	$daily = (float)($acc + $food + $trans + ($extra/$days));
    	$group = (float)(session()->get('groupsize'));
    	$grouply = (float)($daily * $group);
        session()->put('daily', $daily);

    	?>

    		<h1>${{ number_format($daily,2,'.','') }}</h1>
    		<p>per day</p>
    		<h5>${{ number_format($grouply,2,'.','') }} group per day</h5>

    	</div>
    	<div class="col-md-3">

    		

    	</div>
    </div>
    	<div class="col-md-12"><hr>
   		
        	@if(Auth::check())
        		@if(null !==(session()->get('id')))

          		<a href="{{ action('PageController@update', session()->get('id'))}}"><input type="button" class="btn btn-default"value="Update intinerary"></a>
          		<a href="/cancel"><input type="button" class="btn btn-default" value="Cancel"></a>
          		@else

          		<a href="/save"><input type="button" class="btn btn-default" value="Save this itinerary"></a>
          		<a href="/location"><input type="button" class="btn btn-default" value="Cancel"></a>
          		@endif
          	@else
          	<a href="{{ action('PageController@startover')}}"><input type="button" class="btn btn-default" value="Start Over"></a>
          	<?php session()->put('itinerary', 'yes'); ?> 
          	<a href="/auth/login"><input type="button" class="btn btn-default" value="Save this itinerary"></a>
          	@endif
		</div></div>
	


</div>
	
	<?php if(isset($entertainment) && is_array($entertainment))
	{
		session()->put('entertainment', $entertainment);

	} ?>

@stop

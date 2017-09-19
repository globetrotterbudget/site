
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

@section('title')
<title>Summary</title>
@stop

@section('content')

<div id="summaryBlade" class="container">

 	<div class="row">
    	<div class="col-md-12">
    		<h2 class="tripLocation">{{ $array['location'] }}</h2>
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
        <h5 class="costItem"><span class="indivCost">Entertainment extras:</span></h5>

    		@if(isset($entertainment) && is_array($entertainment))
				@foreach($entertainment as $things)

					<h5 class="costItem">{{ $things['description'] . ': '}}<br>
					{{ '$' . number_format(($things['price']),2,'.','') }}<br></h5>
					<?php   $entTotal = 0;
							$entTotal += (int)($things['price']); ?>

				@endforeach
			@else
			
			<h5 class="costItem">none</h5>
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
    	$daily = (float)($acc + $food + $trans + ($extra/$days));
    	$group = (float)(session()->get('groupsize'));
    	$grouply = (float)($daily * $group);
        session()->put('daily', $daily);

    	?>
            <h1 style="display:none" class="dailyNumber" data-daily="{{$daily}}">${{ $daily }}</h1>
    		<h1 class="dailyNumber" style="display:inline-block">${{ number_format($daily,2,'.','') }} <p style="display:inline-block; font-size:16px"><span>/ day</span></p></h1>
    		
    		<h5 class="costItem"><span class="indivCost">${{ number_format($grouply,2,'.','') }}</span> group per day</h5>

    	</div>
    	<div class="col-md-3">

    		

    	</div>
    </div>
    	<div class="col-md-12"><hr>
   		
        	@if(Auth::check())
        		@if(null !==(session()->get('id')))

          		<button class="gtButton"><a href="{{ action('PageController@update', session()->get('id'))}}">Update intinerary</a></button>
          		
                <button class="gtButton2"><a href="/cancel">Cancel</a></button>
          		@else

          		<button class="gtButton"><a href="/save">Save this itinerary</a></button>
          		<button class="gtButton2"><a href="/location">Cancel</a></button>
          		@endif
            @else
            <?php session()->put('itinerary', 'yes'); ?> 
            <button class="gtButton"><a href="/auth/login">Save this itinerary</a></button>
            <button class="gtButton2"><a href="{{ action('PageController@startover')}}">Start Over</a></button>
          	@endif
		</div></div>
	


</div>
	
	<?php if(isset($entertainment) && is_array($entertainment))
	{
		session()->put('entertainment', $entertainment);

	} ?>

@stop

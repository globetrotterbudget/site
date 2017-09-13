@extends('layouts.master')

@section('title')
<title>Summary</title>
@stop

@section('content')

<div class="container">
	<div id="wizard" class="col-md-8 parent-container">
		<div id="content">
			<div class="row">

			<?php $entString = session()->get('entertainment');

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
						
					  ?>
						
			
			<?php $location = $array['location']; ?>
				<div id="locationBox" class="container">
			 		<h4 class="category">{{ $location }}</h4>
				</div>
			</div><br>
			
        	@if(Auth::check())
        		@if(isset($array['id']))
          		<a href="{{ action('PageController@update', $array['id'])}}"><input type="button" class="btn btn-default"value="Update intinerary"></a>
          		<a href="/cancel"><input type="button" class="btn btn-default" value="Cancel"></a>
          		@else
          		<a href="/save"><input type="button" class="btn btn-default" value="Save this itinerary"></a>
          		@endif
          	@else
          	<a href="{{ action('PageController@startover')}}"><input type="button" class="btn btn-default" value="Start Over"></a>
          	<?php session()->put('itinerary', 'yes'); ?> 
          	<a href="/auth/login"><input type="button" class="btn btn-default" value="Save this itinerary"></a>
          	@endif
		</div>
	</div>
	<div class="col-md-4">
		<div id="sidebar">
			
				<?php $location = array_shift($array);
						$nothing = array_pop($array); 
						unset($array['id']); ?>


			@foreach( $array as $key => $value )

				<p>{{ $key . ':'}}</p>
				<div class="row">
					<h4 class="category">{{ $value }}</h4>
				 	<a class="sidebarEdit" href="/{{ $key }}">edit</a>
				 </div>
			@endforeach
			
			<p>Entertainment<br>
					
					@foreach($entertainment as $things)

						{{ $things['description'] . ': '}}
						{{ $things['price'] . ': '}}<br>

					@endforeach
				</p>
				<a class="sidebarEdit" href="/entertainment">edit</a>
		</div>
	</div>

</div>

				<?php session()->put('entertainment', $entertainment); ?>
@stop

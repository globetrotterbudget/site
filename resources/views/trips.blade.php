@extends('layouts.master')

@section('title')
<title>Trips</title>
@stop

@section('content')

<div class="container">

    <div class="col-md-offset-1 col-md-10 parent-container">

    	<h2 id="tripsHeader">Trips</h2>
    	
    	<div class="col-md-12">
		<?php $i = 0; ?>
    	<?php foreach($tripNames as $trip)
		{	
			echo

			"<a class='chips' href=\"/trips/$trip->trip_name\">" .
			"<div class=\"trips\">" .
			'<h3 class="costItem">' . $trip->trip_name . '</h3>'.
			'<h1>$' .
			number_format((float)$costs[$i][0],2,'.','') . '</h1>' .
			'<p style="font-size:14px; color:#bbb">total cost</p>' .
			'<h4>$' .
			number_format((float)$costs[$i][1],2,'.','') . ' daily</h4><br>' .
			"</div>" . '</a>' ;

			$i++;
		}?>

		</div>

    </div>

 </div>
@stop
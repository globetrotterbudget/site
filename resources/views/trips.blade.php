@extends('layouts.master')

@section('title')
<title>Trips</title>
@stop

@section('content')

<div class="container">

    <div class="col-md-offset-2 col-md-8 parent-container">

    	<h2>My Trips</h2>
    	
			<?php $i = 0; ?>
    	
    	<?php foreach($tripNames as $trip)
		{	
			echo

			"<a href=\"/trips/$trip->trip_name\">" .
			"<div class=\"trips\">" .
			'<h3 style="margin-bottom: 5px">' . $trip->trip_name . '</h3>'.
			'<h1 style="margin-top: 10px; margin-bottom: 5px">$' .
			number_format((float)$costs[$i][0],2,'.','') . '</h1>' .
			'<p style="font-size:14px">total cost</p>' .
			'<h4>$' .
			number_format((float)$costs[$i][1],2,'.','') . ' daily</h4><br>' .
			"</div>" . '</a>' ;

			$i++;
		}?>

    </div>

 </div>
@stop
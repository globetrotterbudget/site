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
    
    @foreach($trips as $object)
    
    <div class="row">
    	<div class="col-md-12">
    		<h3>{{$object->location}}</h3>
    	</div>
    	<div class="col-md-3">
    		<h5>Travelers: {{$object->groupsize}}</h5>
    		<h5>Days: {{$object->days}}</h5>
    		<h5>Transportation:</h5>
    		<h5>{{$object->transportation}}</h5>
    		<h5>Food: {{$object->food}}</h5>
    	</div>
    	<div class="col-md-4">
    		<h5>Accommodations:</h5>
    		<h5>{{$object->accommodations}}</h5>
    		<h5>Entertainment:</h5>
    		<p>Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, Lorem Ipsum, </p>
    	</div>
    	<div class="col-md-2">
    		<h1>${{ $object->daily }}</h1>
    		<p>per day</p>
    	</div>
    	<div class="col-md-3">
    		<a href="/trips/{{ $object->id }}/edit" class="btn btn-default">Edit</a>
    		<a href="#" class="btn btn-default">Delete {{ $object->id }}</a>

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
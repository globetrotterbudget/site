@extends('layouts.master')

@section('title')

<title>Food and Dining</title>
@stop

@section('content')
<div class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="content">
            <h2>How would you prefer to commute on your trip?</h2>
				<form method="GET" action="{{ action('PageController@food')}}">
				{{ csrf_field() }}
		            <button type="submit" name="food" value='lowest'>$</button>
       				<button type="submit" name="food" value='modest'>$$</button>
        			<button type="submit" name="food" value='highest'>$$$</button>
				</form>
        </div>
    </div>
    @if(!empty($array)) 
    <div class="col-md-4">
        <div id="sidebar">
        <div class="row">
			<?php $location = array_shift($array); ?>
		 	<h4 class="category">{{ $location }}</h4>
		 	<a class="sidebarEdit" href="">edit</a>
		</div>
        @foreach( $array as $key => $value )
            <p>{{ $key . ':'}}</p>
            <div class="row">
                <h4 class="category">{{ $value }}</h4>
                <a class="sidebarEdit" href="/{{ $key }}">edit</a>
             </div>
        @endforeach
        </div>
    @endif
    </div>
@stop
@extends('layouts.master')

@section('title')

<title>Food and Dining</title>
@stop

@section('content')
<div class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="content">
            <div class="row">
                <?php $location = $array['location']; ?>
                <div id="locationBox" class="container">
                        <h4 class="category">{{ $location }}</h4>
                </div>
            </div>
            <h2>Select a Meal Preference Budget</h2>
                <span data-dollar=0 class="dollarsign">$</span>
                <span data-dollar=1 class="dollarsign">$$</span>
                <span data-dollar=2 class="dollarsign">$$$</span>

                <p id="foodDesc"></p>

                <form method="GET" action="{{ action('PageController@entertainment')}}">
				{{ csrf_field() }}

                    <input type="hidden" name="food" id="foodValue" value="">
                    <a href="/transportation"><input type="button" class="btn btn-default" value="Previous"></a>
                    <button id="foodButton" class="btn btn-default" type="submit">Submit</button>

                </form>
        </div>
    </div>
    @if(!empty($array)) 
    <div class="col-md-4">
        <div id="sidebar">
    
		<?php $location = array_shift($array); ?>
	
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
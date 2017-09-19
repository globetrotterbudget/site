<?php

// dd($array);
$aapd = $array['Average Accomodation Cost per Person per Day'];
$tcpd = $array['Transportation Cost per Person per Day'];
$tcp = $array['Transportation Cost per Person'];
$ttc = $array['Total Trip Cost'];
$total = ($aapd + $tcpd)

?>



@extends('layouts.master')

@section('title')

<title>Food and Dining</title>
@stop

@section('content')

<?php $location = $array['location']; ?>

<div id="foodBlade" class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="locationBox" class="row">
            <h4>{{ $location }}</h4>
        </div>
        <div id="content">
            <div class="row">
                <br>
            </div>
                <h2>Select a Meal Preference Budget</h2>
                <span data-dollar='lowest' class="dollarsign">$</span>
                <span data-dollar='modest' class="dollarsign">$$</span>
                <span data-dollar='luxury' class="dollarsign">$$$</span>

                <p id="foodDesc"></p>

                <form method="GET" action="{{ action('PageController@food')}}">
				{{ csrf_field() }}

                    <input type="hidden" name="food" id="foodValue">
                    <button class="gtButton2"><a href="/transportation">Previous</a></button>
                    <button id="foodButton" class="gtButton" type="submit"><a>Submit</a></button>
                </form>
                <div style="margin-top:20px" class="row">
                    <div id="runningTotal">
                        <p>Current Total</p>
                         <h1 style="margin-top:10px; margin-bottom:5px">$ {{ $total }}</h1>
                        <p>per person / day</p>
                    </div>
                </div>

        </div>
    </div>
    @if(!empty($array)) 
    <div class="col-md-4">
        <div id="sidebar">
    
		<?php $location = array_shift($array); ?>

        
            <p>Days:</p>
            <div class="row">
                <h4 class="category">{{ $array['days'] }}</h4>
                <a class="sidebarEdit" href="/days">edit</a>
             </div>
             <p>Groupsize:</p>
            <div class="row">
                <h4 class="category">{{ $array['groupsize'] }}</h4>
                <a class="sidebarEdit" href="/groupsize">edit</a>
             </div>
             <p>Accommodations:</p>
            <div class="row">
                <div class="starNumber" style="display:none;">{{ $array['accommodations'] }}</div>
                <h4 class="category starSidebar"></h4>
                <a class="sidebarEdit" href="/accommodations">edit</a>
             </div>
             <p>Transportation:</p>
            <div class="row">
                <h4 class="category">{{ $array['transportation'] }}</h4>
                <a class="sidebarEdit" href="/transportation">edit</a>
             </div>

        
        </div>
    @endif
    </div>
@stop
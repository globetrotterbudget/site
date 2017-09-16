<?php

$aapd = $array['Average Accommodation Cost per Person per Day'];
$tcpd = $array['Average Transportation Cost Per Person Per Day'];
// $tcp = $array['Transportation Cost per Person'];
$ttc = $array['Total Trip Cost'];
$mcpd = $array['Meal Cost per Day Per Person'];
$mcp = $array['Meal Cost per Person'];
$total = ($aapd + $tcpd + $mcpd);

if(($array['food']) == 'lowest')
{
    $food = '$';
}
if(($array['food']) == 'modest')
{
    $food = '$$';
}
if(($array['food']) == 'luxury')
{
    $food = '$$$';
}

?>


@extends('layouts.master')

@section('title')
<title>Entertianment</title>
@stop

@section('content')

<?php $location = $array['location']; ?>

<div id="entBlade" class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="locationBox" class="row">
            <h4>{{ $location }}</h4>
        </div>
        <div id="content">
            <div class="row">
                <br>
            </div>
            <h2>Choose Entertainment for your trip.</h2>
            @foreach($entertainmentOptions as $entertainmentOption)
                    <div class="entOptions" data-ent="{{$entertainmentOption->description}}" data-price="{{ $entertainmentOption->cost }}">
                        <h4 style="pointer-events:none">{{ $entertainmentOption->description}}</h4>
                        <p  style="pointer-events:none">{{ $entertainmentOption->cost}}</p>
                    </div>
            @endforeach
            <form method="GET" action="{{ action('PageController@entertainment') }}">
                {{ csrf_field() }}
            <input id="getEntertainment" type="hidden" name="entertainment">
            <button type='submit' class='btn btn-default'>Next</button>
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
                        <h4 class="category">{{ $array['accommodations'] }}</h4>
                        <a class="sidebarEdit" href="/accommodations">edit</a>
                     </div>
                     <p>Transportation:</p>
                    <div class="row">
                        <h4 class="category">{{ $array['transportation'] }}</h4>
                        <a class="sidebarEdit" href="/transportation">edit</a>
                     </div>
                     <p>Food / Drink:</p>
                    <div class="row">
                    
                        <h4 class="category">{{ ($array['food']) }}</h4>
                        <a class="sidebarEdit" href="/transportation">edit</a>
                     </div>
                </div>
    @endif
    </div>
@stop
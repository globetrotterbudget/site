@extends('layouts.master')

@section('title')
<title>Transportation for Travel</title>
@stop

@section('content')


<?php $location = $array['location']; ?>

<div id="transsBlade" class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="locationBox" class="row">
            <h4>{{ $location }}</h4>
        </div>
        <div id="content">
            <div class="row">
                <br>
            </div>
            <h2>How would you prefer to commute on your trip?</h2>
            
            <div id="transpo" class="row">

                <input class="publicTrans" type="button" id="public" data-transportation="public" value="public">
                <input class="rentalTrans" type="button" id="rental" data-transportation="rental" value="rental">

                <form method="GET" action="{{ action('PageController@transportation')}}">
                {{ csrf_field() }}
                    <br>
                    <input id="hiddenTrans" type="hidden" name="transportation" value="">
                    <a href="/accommodations"><input type="button" class="btn btn-default" value="Previous"></a>
                    <button id="transportation" class="btn btn-default" type="submit">Submit</button>
                    
                </form>
            </div>
            <div style="margin-top:20px" class="row">
            <?php $avgCostDay = array_pop($array); ?>
                    <div id="runningTotal">
                        <p>Current Total</p>
                         <h1 style="margin-top:10px; margin-bottom:5px">$ {{ $avgCostDay }}</h1>
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
             


        </div>
    @endif
    </div>
@stop

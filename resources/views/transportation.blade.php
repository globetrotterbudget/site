@extends('layouts.master')

@section('title')
<title>Transportation for Travel</title>
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
            <h2>How would you prefer to commute on your trip?</h2>
            
            <div id="transpo" class="row">

                <input type="button" id="public" data-transportation="public" value="public">
                <input type="button" id="rental" data-transportation="rental" value="rental">

                <form method="GET" action="{{ action('PageController@transportation')}}">
                {{ csrf_field() }}
                    <br>
                    <input id="hiddenTrans" type="hidden" name="transportation" value="">
                    <a href="/accommodations"><input type="button" class="btn btn-default" value="Previous"></a>
                    <button id="transportation" class="btn btn-default" type="submit">Submit</button>
                    
                </form>
            </div>

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

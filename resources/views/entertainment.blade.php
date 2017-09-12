@extends('layouts.master')

@section('title')
<title>Entertianment</title>
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
            <h2>Choose Entertainment for your trip.</h2>

                @foreach($entertainmentOptions as $entertainmentOption )
                    <div>
                        <h2>{{ $entertainmentOption->description}}</h2>
                        <p>{{ $entertainmentOption->cost}}</p>
                    </div>
                @endforeach
        <form method="GET" action="{{ action('PageController@entertainment') }}">
            @for($i = 0; $i <= count($entertainmentOptions); $i++)
                <input type=hidden name='entertainment[]' id=$i value=''>
            @endfor
            <button type='submit'>Next</button>
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
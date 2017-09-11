@extends('layouts.master')

@section('title')
<title>Entertianment</title>
@stop

@section('content')


<div class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="content">
            <h2>Choose Entertainment for your trip.</h2>
            <form method="GET" action="{{ action('PageController@entertainment') }}">
                {{ csrf_field() }}

                @foreach($entertainmentOptions as $entertainmentOption )
                    <div>
                        <h2>{{ $entertainmentOption->description}}</h2>
                        <p>{{ $entertainmentOption->cost}}</p>
                    </div>
                @endforeach

            <div>
                <input type="checkbox" name="entertainment[]" value='pack6'>
                <input type="checkbox" name="entertainment[]" value='pack7'>
                <input type="checkbox" name="entertainment[]" value='pack8'>
                <input type="checkbox" name="entertainment[]" value='pack9'>
                <input type="checkbox" name="entertainment[]" value='pack10'>
            </div>
            <div>
                <input type="checkbox" name="entertainment[]" value='pack11'>
                <input type="checkbox" name="entertainment[]" value='pack12'>
                <input type="checkbox" name="entertainment[]" value='pack13'>
                <input type="checkbox" name="entertainment[]" value='pack14'>
                <input type="checkbox" name="entertainment[]" value='pack15'>
            </div>
            <button type='submit'>Next</button>
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
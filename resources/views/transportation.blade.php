@extends('layouts.master')

@section('title')
<title>Transportation for Travel</title>
@stop

@section('content')

<div class="container">
    <div id="wizard" class="col-md-8 parent-container">
        <div id="content">
            <h2>How would you prefer to commute on your trip?</h2>
				<form method="GET" action="{{ action('PageController@transportation')}}">
				{{ csrf_field() }}
		            <button type="submit" name="transportation" value='public'>Public</button>
		            <button type="submit" name="transportation" value='rental'>Rental</button>
				</form>
        </div>
    </div>
    @if(!empty($array)) 
    <div class="col-md-4">
        <div id="sidebar">
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


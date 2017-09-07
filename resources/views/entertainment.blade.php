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
                <div>
                <button type="submit" name="entertainment" value='pack1'>$95</button>
                <button type="submit" name="entertainment" value='pack2'>$95</button>
                <button type="submit" name="entertainment" value='pack3'>$95</button>
                <button type="submit" name="entertainment" value='pack4'>$95</button>
                <button type="submit" name="entertainment" value='pack5'>$95</button>
            </div>
            <div>
                <button type="submit" name="entertainment" value='pack6'>$95</button>
                <button type="submit" name="entertainment" value='pack7'>$95</button>
                <button type="submit" name="entertainment" value='pack8'>$95</button>
                <button type="submit" name="entertainment" value='pack9'>$95</button>
                <button type="submit" name="entertainment" value='pack10'>$95</button>
            </div>
            <div>
                <button type="submit" name="entertainment" value='pack11'>$95</button>
                <button type="submit" name="entertainment" value='pack12'>$95</button>
                <button type="submit" name="entertainment" value='pack13'>$95</button>
                <button type="submit" name="entertainment" value='pack14'>$95</button>
                <button type="submit" name="entertainment" value='pack15'>$95</button>
            </div>
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
                <a class="sidebarEdit" href="">edit</a>
             </div>
        @endforeach
        </div>
    @endif
    </div>
@stop
@extends('layouts.master')

@section('title')
<title>Entertianment</title>
@stop

@section('content')
<h2>Choose Entertainment for your trip.</h2>
<form method="GET" action="{{ action('PageController@entertainment') }}">
		{{ csrf_field() }}
	<div>
        <input type="checkbox" name="entertainment[]" value="pack1">
        <input type="checkbox" name="entertainment[]" value="pack2">
        <input type="checkbox" name="entertainment[]" value="pack3">
        <input type="checkbox" name="entertainment[]" value="pack4">
        <input type="checkbox" name="entertainment[]" value="pack5">
    </div>
    <div>
        <input type="checkbox" name="entertainment[]" value="pack6">
        <input type="checkbox" name="entertainment[]" value="pack7">
        <input type="checkbox" name="entertainment[]" value="pack8">
        <input type="checkbox" name="entertainment[]" value="pack9">
        <input type="checkbox" name="entertainment[]" value="pack10">
    </div>
    <div>
        <input type="checkbox" name="entertainment[]" value="pack11">
        <input type="checkbox" name="entertainment[]" value="pack12">
        <input type="checkbox" name="entertainment[]" value="pack13">
        <input type="checkbox" name="entertainment[]" value="pack14">
        <input type="checkbox" name="entertainment[]" value="pack15">
        
    </div>

    <button type="submit">Next</button>

</form>
@stop
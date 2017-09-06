@extends('layouts.master')

@section('title')
	<title>Home</title>
@stop

@section('content')
	<div class="container">
    	<h1>Where would you like to go?</h1>
   		<form method='GET' action="{{ action('PageController@location') }}">
        <input class='form-control' type='text' name='location'>
        <button  class='btn btn-success' type='submit'>Go</button>
      </form>
	</div>
@stop
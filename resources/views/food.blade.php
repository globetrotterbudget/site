@extends('layouts.master')

@section('title')

<title>Food and Dining</title>
@stop

@section('content')
<h2>The "$$" Budget are for most meals at modestly priced restaurnts.</h2>
<form method="GET" action="{{ action('PageController@food') }}">
        {{ csrf_field() }}

        <button type="submit" name="food" value='lowest'>$</button>
        <button type="submit" name="food" value='modest'>$$</button>
        <button type="submit" name="food" value='highest'>$$$</button>

</form>
@stop
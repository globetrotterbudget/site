@extends('layouts.master')

@section('title')
<title>Food and Dining</title>
@stop

@section('content')
<h2>The "$$" Budget are for most meals at modestly priced restaurnts.</h2>
<form method="POST" action="">
		{{ csrf_field() }}
		<button type="submit" name="$" value='lowest'>$</button>
        <button type="submit" name="$$" value='modest'>$$</button>
        <button type="submit" name="$$$" value='highest'>$$$</button>
</form>
@stop
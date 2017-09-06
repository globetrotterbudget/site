@extends('layouts.master')

@section('title')
<title>Entertianment</title>
@stop

@section('content')
<h2>Choose Entertainment for your trip.</h2>
<form method="POST" action="">
		{{ csrf_field() }}
		<div>
		<button type="submit" name="$1" value='pack1'>$95</button>
        <button type="submit" name="$2" value='pack2'>$95</button>
        <button type="submit" name="$3" value='pack3'>$95</button>
        <button type="submit" name="$4" value='pack4'>$95</button>
        <button type="submit" name="$5" value='pack5'>$95</button>
    </div>
    <div>
        <button type="submit" name="$6" value='pack6'>$95</button>
        <button type="submit" name="$7" value='pack7'>$95</button>
        <button type="submit" name="$8" value='pack8'>$95</button>
        <button type="submit" name="$9" value='pack9'>$95</button>
        <button type="submit" name="$10" value='pack10'>$95</button>
    </div>
    <div>
        <button type="submit" name="$11" value='pack11'>$95</button>
        <button type="submit" name="$12" value='pack12'>$95</button>
        <button type="submit" name="$13" value='pack13'>$95</button>
        <button type="submit" name="$14" value='pack14'>$95</button>
        <button type="submit" name="$15" value='pack15'>$95</button>
    </div>
</form>
@stop
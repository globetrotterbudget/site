@extends('layouts.master')

@section('title')
<title>Transportation for Travel</title>
@stop

@section('content')

<h2>How would you prefer to commute on your trip?</h2>
<form method="POST" action="">
            {{ csrf_field() }}
            <button type="submit" name="public" value='public'>Public</button>
            <button type="submit" name="rental" value='rental'>Rental</button>
</form>
@stop
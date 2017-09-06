@extends('layouts.master')

@section('title')
    <title>User Page</title>
@stop

@section('content')


<form method="POST" action="">
    {!! csrf_field() !!}

    <div>
        Username
        <input type="username" name="username" value="{{ old('username') }}">
    </div>
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

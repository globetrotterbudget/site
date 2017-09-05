@extends('layouts.master')

@section('title')
    <title>Login</title>
@stop

@section('content')


<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Username
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

@stop
@extends('layouts.master')

@section('title')
    <title>Login</title>
@stop

@section('content')
    
<div class="container">

    <div id="wizard" class="col-md-offset-2 col-md-8 parent-container">
        <div id="login">
            <h2>This is where you log in</h2>
            <form method="POST" action="/auth/login">
                {!! csrf_field() !!}

                <div>
                    <label for="email">Username</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div>
                    <input type="checkbox" name="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <div>
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>


@stop
@extends('layouts.master')

@section('title')
    <title>Register</title>
@stop

@section('content')

<div class="container">

    <div id="wizard" class="col-md-offset-2 col-md-8 parent-container">

    <div id="signup">
        <h2>Register</h2>
        <form method="POST" action="/auth/register">
            {!! csrf_field() !!}

                <div>
                   <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>

                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation">
                </div>

                <div>
                    <button type="submit">Register</button>
                </div>
            </form>
            </div>

        </div>
    </div>


@stop
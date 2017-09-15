@extends('layouts.master')

@section('title')
    <title>Register</title>
@stop

@section('content')
@if (count($errors))
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>
@endif 
<div class="container">

    <div id="login_box" class="col-md-offset-2 col-md-8 parent-container">

    <div id="signup">
        <h2>Register</h2>
        <form method="POST" action="/auth/register">
            {!! csrf_field() !!}

                <div class='form-group'>
                   <label for="name">Name</label>
                   <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>

                <div class='form-group'>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                <div class='form-group'>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class='form-group'>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password" required>
                </div>
                <div class='form-group'>
                    <div class='row login_row'>
                        <button type="submit" class="btn btn-success col-sm-2 col col-sm-offset-5">Register</button>
                    </div>
                    <div class='row login_row'>
                        <a href="/auth/login"><input type="button" class="btn btn-default col-sm-2 col col-sm-offset-5" value="Login" name=""></a>
                    </div>
                </div>
            </form>
            </div>

        </div>
    </div>


@stop
@extends('layouts.master')

@section('title')
    <title>Login</title>
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
    <div id="wizard" class="col-md-offset-2 col-md-8 parent-container">
        <div id="login">            
            <form method="POST" action="/auth/login" data-validation data-required-message="This field is required">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div>
                    <input type="checkbox" name="remember">
                    <label for="remember">Remember Me</label>
                </div class='form-group'>
                    <div class='row login_row'>
                        <input type="submit" class="btn btn-success col-sm-2 col col-sm-offset-5" value="Login">
                    </div>
                    <div class='row login_row'>
                        <a href="/auth/register"><input type="button" class="btn btn-default col-sm-2 col col-sm-offset-5" value="Sign Up" name=""></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@stop
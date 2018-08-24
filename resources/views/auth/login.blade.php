@extends('layouts.auth')

@section('title')
    <title>PoS - Login</title>
@endsection

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('login') }}" method="post">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {!! session('error') !!}
                </div>
            @endif
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
@endsection

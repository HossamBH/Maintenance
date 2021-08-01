@extends('layout.authentication')
@section('title', 'Login')


@section('content')
<div class="pattern">
    <span class="red"></span>
    <span class="indigo"></span>
    <span class="blue"></span>
    <span class="green"></span>
    <span class="orange"></span>
</div>

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);"><img src="{{url('/assets/images/icon.svg')}}" width="30" height="30" class="d-inline-block align-top mr-2" alt="">Accounting</a>
        </div>
        <div class="card">
            <div class="body">
                <p class="lead">Login to your account</p>
                <form class="form-auth-small m-t-20" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input id="email" type="email"
                        class="form-control round @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required
                        autocomplete="email" autofocus placeholder="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input id="password" type="password"
                        class="form-control round @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input class="form-check-input" type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>								
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                    <div class="bottom">
                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="">Forgot password?</a></span>
                    <span>Don't have an account? <a href="{{route('register')}}">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
@stop

@section('page-styles')

@stop

@section('page-script')

@stop
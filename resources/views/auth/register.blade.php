@extends('layout.authentication')
@section('title', 'Register')


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
            <a class="navbar-brand" href="javascript:void(0);"><img src="{{url('../assets/images/icon.svg')}}" width="30" height="30" class="d-inline-block align-top mr-2" alt="">Accounting</a>                                                
        </div>
        <div class="card">
            <div class="body">
                <p class="lead">Create an account</p>
            <form class="form-auth-small m-t-20" method="POST" action="{{route('register')}}">
                @csrf
                    <div class="form-group">
                        <input id="name" type="text" class="form-control round @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control round" placeholder="Your email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">                            
                        <input type="password" class="form-control round" placeholder="Password" @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">                            
                        <input id="password-confirm" type="password" class="form-control round" name="password_confirmation" required autocomplete="new-password" placeholder="Comfirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">
                        {{ __('Register') }}
                    </button>                               
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
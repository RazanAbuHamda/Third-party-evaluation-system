@extends('layouts.auth-layout')
@section('auth-body')
    <body>
    <div class="login-content">
        <!-- Register -->
        <div class="nk-block toggled" id="l-login">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="nk-form">
                    <div class="input-group">
                            <span class="input-group-addon nk-ic-st-pro"><i
                                    class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input type="text" name="name" class="form-control" placeholder="Username">
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                        <div class="nk-int-st">
                            <input type="text" name="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                        <div class="nk-int-st">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <a href="{{route('login')}}" data-ma-action="nk-login-switch" data-ma-block="#l-login"
                       class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
                </div>

                <div class="nk-navigation nk-lg-ic">
                    <a href="{{route('register')}}" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i
                            class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" data-ma-action="nk-login-switch"
                           data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
                @endif
                </div>
            </form>
        </div>
    </div>
    </body>

@endsection

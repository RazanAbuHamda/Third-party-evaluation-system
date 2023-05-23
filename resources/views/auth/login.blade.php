@extends('layouts.auth-layout')
@section('auth-body')
    <body>
    <div class="login-content">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
            <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="nk-form">
                    <div class="input-group">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                        <div class="nk-int-st">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="fm-checkbox">
                        <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
                    </div>
                    <a href="{{ route('register') }}" data-ma-action="nk-login-switch" data-ma-block="#l-register"
                       class="btn btn-login btn-success btn-float"><i
                            class="notika-icon notika-right-arrow right-arrow-ant"></i></a>
                </div>

                <div class="nk-navigation nk-lg-ic">
                    <a href="{{ route('register') }}" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i
                            class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
                    @endif
                </div>
                <button>login</button>
            </form>
        </div>
    </div>
    </body>

@endsection

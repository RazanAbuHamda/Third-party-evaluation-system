@extends('layouts.auth-layout')

@section('auth-body')
    <body style="background-color: #F7C049;">
    <div class="login-content" style="background-color: #F7C049; display: flex; flex-direction: column;margin-top: -180px">
        <!-- Logo -->
        <div class="logo-area" style="">
            <a href="#"><img src="{{ asset('dashboardPublic/img/logoAuth.jpeg') }}" alt="Logo" class="logo-img"></a>
        </div>
        <div class="nk-block toggled" id="l-register" style="margin-top: -180px">
            <div class="form-header" style="position: fixed; top: 0; left: 0; width: 400px; border-radius: 10px; padding: 30px; background-color: #FFFFFF; margin-left: 50px;">
                <h4>Sign Up</h4><hr>
            </div>
            <form id="register-form" method="POST" action="{{ route('register') }}" style="width: 400px; height: 550px; padding: 20px; background-color: #FFFFFF; border-radius: 10px; margin-left: 50px;">
                @csrf
                <div class="nk-form" style="margin-top: 40px">
                    <div class="input-group" style="margin-bottom: 15px;">
                        <div class="input-group" style="margin-bottom: 15px;">
                            <div class="nk-int-st">
                                <label style="float: left">Username</label>
                                <input type="text" name="name" class="form-control rounded" placeholder="Name" style="height: 40px; padding-left: 40px; background-image: url('{{ asset('dashboardPublic/img/name-icon.png') }}'); background-repeat: no-repeat; background-position: left center;">
                            </div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 15px;">
                        <div class="input-group" style="margin-bottom: 15px;">
                            <div class="nk-int-st">
                                <label style="float: left">Email</label>
                                <input type="text" name="email" class="form-control rounded" placeholder="Email" style="height: 40px; padding-left: 40px; background-image: url('{{ asset('dashboardPublic/img/email-icon.png') }}'); background-repeat: no-repeat; background-position: left center;">
                            </div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 15px;">
                        <div class="input-group" style="margin-bottom: 15px;">
                            <div class="nk-int-st">
                                <label style="float: left">Password</label>
                                <input type="password" name="password" class="form-control rounded" placeholder="Password" style="height: 40px; padding-left: 40px; background-image: url('{{ asset('dashboardPublic/img/password-icon.png') }}'); background-repeat: no-repeat; background-position: left center;">
                            </div>
                        </div>
                    </div>
{{--                    <div class="input-group" style="margin-bottom: 15px;">--}}
{{--                        <div class="input-group" style="margin-bottom: 15px;">--}}
{{--                            <div class="nk-int-st">--}}
{{--                                <label style="float: left">Confirm Password</label>--}}
{{--                                <input type="password" name="password_confirmation" class="form-control rounded" placeholder="Confirm Password" style="height: 40px; padding-left: 40px; background-image: url('{{ asset('dashboardPublic/img/password-icon.png') }}'); background-repeat: no-repeat; background-position: left center;">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <button class="btn btn-primary rounded" style="background-color: #F7C049; border-radius: 50px; border-color: #F7C049; width: 200px; height: 40px; font-size: 15px">Sign Up</button>
                    <div class="form-footer" style="position: fixed; bottom: 0; left: 0; width: 400px; border-radius: 10px; padding: 30px; background-color: #FFFFFF; text-align: center; margin-left: 50px;">
                        <span style="margin-right: 10px">Already have an account?</span>
                        <a href="{{ route('login') }}">Sign In</a>
                    </div>
                </div>
                <div class="nk-navigation nk-lg-ic" style="margin-top: 15px;">
                    <a href="{{ route('login') }}" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-minus-symbol"></i> <span>Sign In</span></a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    </body>
@endsection

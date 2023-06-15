@extends('layouts.auth-layout')

@section('auth-body')
    <body style=" background-color: #F7C049;">
    <div class="login-content" style="background-color: #F7C049; display: flex; flex-direction: column;margin: -180px">
        <!-- Logo -->
        <div class="logo-area" style="">
            <a href="#"><img src="{{ asset('dashboardPublic/img/logoAuth.jpeg') }}" alt="Logo" class="logo-img"></a>
        </div>
        <div class="nk-block toggled" id="l-login">
            <div class="form-header" style="position: fixed; top: 0; left: 0; width: 400px; border-radius:10px; padding: 30px; background-color: #FFFFFF; margin-left: 50px ">
            <h4>Sign In</h4><hr>
            </div>
            <form id="login-form" method="POST" action="{{ route('login') }}" style="width: 400px; height:550px; padding: 20px; background-color: #FFFFFF; border-radius: 10px;margin-left: 50px">
                @csrf
                <div class="nk-form" style="margin-top: 40px">
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
                    <div class="fm-checkbox" style="margin-bottom: 15px;">
                        <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
                    </div>
                    <button class="btn btn-primary rounded" style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049; width: 200px;height: 40px; font-size: 15px">Sign In</button>
                    <div class="form-footer" style="position: fixed; bottom: 0; left: 0; width: 400px; border-radius:10px; padding: 30px; background-color: #FFFFFF; text-align: center;margin-left: 50px">
                        <span style="margin-right: 10px">you don't have an account?</span>
                        <a href="{{ route('register') }}">Sign Up</a>
                    </div>
                </div>

                <div class="nk-navigation nk-lg-ic" style="margin-top: 15px;">
                    <a href="{{ route('register') }}" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    </body>
@endsection

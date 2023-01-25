@extends('layouts.auth-layout')
@section('auth-body')
    <body>
    <div class="login-content">
        <!-- Forgot Password -->
        <div class="nk-block toggled" id="l-login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="nk-form">
                    <div class="input-group">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur
                                commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
                            <input type="text" name="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>

                    <a href="{{route('login')}}" data-ma-action="nk-login-switch" data-ma-block="#l-login"
                       class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>

                    <div class="nk-navigation nk-lg-ic rg-ic-stl">
                        <a href="{{route('login')}}" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i
                                class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
                        <a href="{{route('register')}}" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i
                                class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
@endsection

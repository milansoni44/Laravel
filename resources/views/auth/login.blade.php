@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
                <div class="center">
                    <h1>
                        <i class="ace-icon fa fa-leaf green"></i>
                        <span class="red">Laravel</span>
                        <span class="white" id="id-text2">Application</span>
                    </h1>
                    <h4 class="blue" id="id-company-text">&copy; {{$settings->system_name}}</h4>
                </div>

                <div class="space-6"></div>

                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header blue lighter bigger">
                                    <i class="ace-icon fa fa-coffee green"></i>
                                    Please Enter Your Information
                                </h4>

                                <div class="space-6"></div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       placeholder="{{ __('E-Mail Address') }}" name="email"
                                                       value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus/>
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </label>

                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" placeholder="{{ __('Password') }}"
                                                       required autocomplete="current-password"/>
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">
                                            <label class="inline">
                                                <input class="ace" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span class="lbl"> {{ __('Remember Me') }}</span>
                                            </label>

                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                <i class="ace-icon fa fa-key"></i>
                                                <span class="bigger-110">{{ __('Login') }}</span>
                                            </button>
                                        </div>

                                        <div class="space-4"></div>
                                    </fieldset>
                                </form>
                            </div><!-- /.widget-main -->

                            <div class="toolbar clearfix">
                                <div>
                                    <!--<a href="#" data-target="#signup-box" class="user-signup-link">
                                        I want to register
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>-->
                                </div>

                                <div>
                                    {{--<a href="#" data-target="#forgot-box" class="forgot-password-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        I forgot my password
                                    </a>--}}
                                    @if (Route::has('password.request'))
                                        <a class="forgot-password-link" href="{{ route('password.request') }}">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            I forgot my password
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.login-box -->
                </div><!-- /.position-relative -->

                {{--<div class="navbar-fixed-top align-right">
                    <br/>
                    &nbsp;
                    <a id="btn-login-dark" href="#">Dark</a>
                    &nbsp;
                    <span class="blue">/</span>
                    &nbsp;
                    <a id="btn-login-blur" href="#">Blur</a>
                    &nbsp;
                    <span class="blue">/</span>
                    &nbsp;
                    <a id="btn-login-light" href="#">Light</a>
                    &nbsp; &nbsp; &nbsp;
                </div>--}}
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

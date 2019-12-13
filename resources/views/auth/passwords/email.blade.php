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
                    <h4 class="blue" id="id-company-text">&copy; Milan Soni</h4>
                </div>

                <div class="space-6"></div>

                <div class="position-relative">
                    <div id="forgot-box" class="forgot-box widget-box no-border visible">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header red lighter bigger">
                                    <i class="ace-icon fa fa-key"></i>
                                    Retrieve Password
                                </h4>

                                <div class="space-6"></div>
                                <p>
                                    Enter your email and to receive instructions
                                </p>

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <fieldset>
                                        <label class="block clearfix" for="email">
                                            <span class="block input-icon input-icon-right">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                       placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </label>

                                        <div class="clearfix">
                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                                                <i class="ace-icon fa fa-lightbulb-o"></i>
                                                <span class="bigger-110">Send Me!</span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!-- /.widget-main -->

                            <div class="toolbar center">
                                <a href="{{ route('login') }}" class="back-to-login-link">
                                    Back to login
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
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

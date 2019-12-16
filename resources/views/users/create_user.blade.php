@extends('layouts.master')

@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="">
                        <a href="{{url('users')}}">Users</a>
                    </li>
                    <li class="active">Create</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        Create User
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            overview &amp; stats
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <form class="form-horizontal" role="form" action="{{ route('users.store') }}" method="post">
                        {{csrf_field()}}
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="form-group @if($errors->has('name')) has-error @endif">
                                    <label class="col-sm-4 control-label" for="name"> Name </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                        @error('name')
                                        <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('email')) has-error @endif">
                                    <label class="col-sm-4 control-label" for="email"> Email </label>

                                    <div class="col-sm-8">
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group @if($errors->has('password')) has-error @endif">
                                    <label class="col-sm-4 control-label" for="password"> Password</label>

                                    <div class="col-sm-8">
                                        <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
                                        @error('password')
                                        <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="conf_password"> Confirm Password</label>

                                    <div class="col-sm-8">
                                        <input type="password" name="password_confirmation" id="conf_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-10 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Submit
                                </button>
                                <a class="btn btn-danger" href="#">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
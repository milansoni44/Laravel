@extends('layouts.master')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="active">Settings</li>
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
                <div class="row">
                    {{--@include('layouts.errors')--}}
                    {{--@include('layouts.success')--}}
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Settings</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">

                                                <form class="form-horizontal" role="form" action="{{ route('settings.save') }}" method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label col-sm-offset-2" for="system_name"> System Name </label>

                                                        <div class="col-sm-4 @if($errors->has('system_name')) has-error @endif">
                                                            <input type="text" id="system_name" class="form-control" name="system_name" value="{{ (old('system_name')) ? old('system_name') : $setting_info->system_name }}" autofocus>
                                                            @error('system_name')
                                                            <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label col-sm-offset-2" for="logo"> System Logo </label>
                                                        <div class="col-sm-4 @if($errors->has('logo')) has-error @endif">
                                                            <input type="file" id="logo" class="form-control" name="logo" />
                                                            @if(isset($setting_info->logo) && $setting_info->logo)
                                                                <img src="{{asset('uploads/logo/'.$setting_info->logo)}}" width="100px"/>
                                                            @endif
                                                            @error('logo')
                                                            <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-xs-12 col-sm-12 center">
                                                            <button class="btn btn-info" type="submit">
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                Submit
                                                            </button>
                                                            <a class="btn btn-danger" href="{{route('settings')}}">
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                Cancel
                                                            </a>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>
    </div>
@endsection

@section('jquery-script')
    <script>
        $(".setting_li").addClass("active");
    </script>
@endsection
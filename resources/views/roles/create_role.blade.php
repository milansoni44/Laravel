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
                        <a href="{{url('roles')}}">Roles</a>
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
                <div class="row">
                    {{--@include('layouts.errors')--}}
                    {{--@include('layouts.success')--}}
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Create Role</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">

                                                <form class="form-horizontal" role="form" action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label col-sm-offset-2" for="name"> Name </label>

                                                        <div class="col-sm-4 @if($errors->has('name')) has-error @endif">
                                                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                                            @error('name')
                                                            <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label col-sm-offset-2" for="description"> Description</label>

                                                        <div class="col-sm-4 @if($errors->has('description')) has-error @endif">
                                                            <textarea class="form-control" id="description" name="description"></textarea>
                                                            @error('description')
                                                            <div class="help-block col-xs-12 col-sm-reset inline text-danger"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-xs-12 col-sm-12 center">
                                                            <button class="btn btn-info" type="submit">
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                Submit
                                                            </button>
                                                            <a class="btn btn-danger" href="{{route('roles.index')}}">
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
        $(".add_role_li").addClass("active")
            .parent()
            .parent().addClass("active open");
    </script>
@endsection
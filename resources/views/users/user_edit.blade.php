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
                <div class="row">
                    {{--@include('layouts.errors')--}}
                    {{--@include('layouts.success')--}}
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Create User</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">

                                                <form class="form-horizontal" role="form" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="name"> Name </label>

                                                        <div class="col-sm-4 @if($errors->has('name')) has-error @endif">
                                                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') ? old('name') : $user->name }}" autofocus>
                                                            @error('name')
                                                            <div class="help-block col-xs-12 col-sm-reset inline"> {{ $message }} </div>
                                                            @enderror
                                                        </div>

                                                        <label class="col-sm-2 control-label" for="email"> Email </label>

                                                        <div class="col-sm-4 @if($errors->has('email')) has-error @endif">
                                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : $user->email }}">
                                                            @error('email')
                                                            <div class="col-xs-12 col-sm-reset inline text-danger"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="password"> Password</label>

                                                        <div class="col-sm-4 @if($errors->has('password')) has-error @endif">
                                                            <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
                                                            @error('password')
                                                            <div class="help-block col-xs-12 col-sm-reset inline text-danger"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                        <label class="col-sm-2 control-label" for="conf_password"> Confirm Password</label>

                                                        <div class="col-sm-4">
                                                            <input type="password" name="password_confirmation" id="conf_password" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="role"> Role</label>
                                                        <div class="col-sm-4 @if($errors->has('role')) has-error @endif">
                                                            <select class="form-control" name="role" id="role">
                                                                <option value="">Select Role</option>
                                                                @foreach($roles as $role)
                                                                    {{ $selectedRole = '' }}
                                                                    @if($role->id == old('role'))
                                                                        {{ $selectedRole = "selected='selected'" }}
                                                                    @else
                                                                        @if($role->id == $user->role_id)
                                                                            {{$selectedRole = "selected='selected'"}}
                                                                        @endif
                                                                    @endif
                                                                    <option value="{{ $role->id }}" {{$selectedRole}}>{{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('role')
                                                            <div class="help-block col-xs-12 col-sm-reset inline text-danger"> {{ $message }} </div>
                                                            @enderror
                                                        </div>

                                                        <label class="col-sm-2 control-label" for="profile"> Profile</label>
                                                        <div class="col-sm-4 @if($errors->has('profile')) has-error @endif">
                                                            <input type="file" id="profile" name="profile" class="form-control">
                                                            @if(isset($user->profile) && $user->profile)
                                                                <img src="{{asset('uploads/'.$user->profile)}}" width="100px"/>
                                                            @endif
                                                            @error('profile')
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
                                                            <a class="btn btn-danger" href="{{route('users.index')}}">
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
    $(".add_user_li").addClass("active")
        .parent()
        .parent().addClass("active open");
</script>
@endsection
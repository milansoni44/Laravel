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
                    <li class="active">
                        <a href="#">Users List</a>
                    </li>
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
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Import Users</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-inline" action="{{route('users.import')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" class="input-small form-control" name="import">
                                    @error('import')
                                    <div class="col-xs-12 col-sm-reset inline text-danger"> {{ $message }} </div>
                                    @enderror
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="ace-icon fa fa-cloud-upload bigger-110"></i>Import
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="{{ route('export') }}"><i class="ace-icon fa fa-cloud-download bigger-110"></i>Export</a>
                                    <p style="color:red;" class="pull-right">Sample file for import user: <a href="{{asset('samples/users/sample_users.xlsx')}}" download>Download</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                    @include('layouts.errors')
                    @include('layouts.success')
                    @include('layouts.custom_flash')
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jquery-script')
<script type="text/javascript">
    $(function () {
        $(".user_list_li").addClass("active")
            .parent()
            .parent().addClass("active open");
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role_name', name: 'role_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        }).on('click', '.delete', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            console.log(url);
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url:url ,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE', "_token": "{{ csrf_token() }}"}
                }).always(function (data) {
                    alert(data.message);
                    $('.data-table').DataTable().draw(false);
                });
            }

        });

    });
</script>
@endsection
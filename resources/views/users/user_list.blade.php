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
                        <a href="#">Users</a>
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
                <div class="page-header">
                    <h1>
                        User List
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            overview &amp; stats
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('layouts.errors')
                    @include('layouts.success')
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
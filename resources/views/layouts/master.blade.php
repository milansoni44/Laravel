<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Ace Admin</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('font-awesome/4.5.0/css/font-awesome.min.css')}}" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="{{asset('css/fonts.googleapis.com.css')}}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{asset('css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('css/ace-part2.min.css')}}" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{asset('css/ace-skins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/ace-rtl.min.css')}}" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('css/ace-ie.min.css')}}" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{asset('js/ace-extra.min.js')}}"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{asset('js/html5shiv.min.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body class="no-skin">

@include('layouts.header')
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    @include('layouts.sidebar')

    @yield('content')

    @include('layouts.footer')

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
</script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
<script src="{{asset('js/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('js/jquery-ui.custom.min.js')}}"></script>
<script src="{{asset('js/jquery.ui.touch-punch.min.js')}}"></script>
{{--<script src="{{asset('js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('js/jquery.sparkline.index.min.js')}}"></script>
<script src="{{asset('js/jquery.flot.min.js')}}"></script>
<script src="{{asset('js/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('js/jquery.flot.resize.min.js')}}"></script>--}}
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.bootstrap.min.js')}}"></script>

<!-- ace scripts -->
<script src="{{asset('js/ace-elements.min.js')}}"></script>
<script src="{{asset('js/ace.min.js')}}"></script>

@yield('jquery-script')
</body>
</html>

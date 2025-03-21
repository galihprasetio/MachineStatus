<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <title>{{config('app.name')}}</title> --}}
    <title>{{config('app.name')}} | @yield('tittle')</title> 
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLte/bower_components/jquery/dist/jquery.min.js')}}"></script>
    {{-- <script src="{{ asset('js/jquery-ui.min.js')}}"></script> --}}
    <script src="{{ asset('js/jquery.chained.js')}}"></script>
    {{-- <script src="{{ asset('js/instascan.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('js/simditor.js')}}"></script> --}}
    <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/Ionicons/css/ionicons.min.css')}}"> --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/select2/dist/css/select2.min.css')}}">
    {{-- Date Time --}}
    {{-- <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/datetime/bootstrap-timepicker.min.css')}}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/skins/skin-yellow.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custome.css')}}">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    {{-- <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        @include('admin.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @stack('header-name')
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

                <!--------------------------
        | Your Page Content Here |
        -------------------------->
                @include('flash-message')
                @include('flash::message') 
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('admin.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a>
                </li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="pull-right-container">
                                        <span class="label label-danger pull-right">70%</span>
                                    </span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('AdminLte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/js/dataTables.fixedHeader.min.js')}}"></script>
    {{-- Date Time --}}
    {{-- <script src="{{ asset('AdminLte/bower_components/datetime/bootstrap-timepicker.min.js')}}"></script> --}}
    <script src="{{ asset('AdminLte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('AdminLte/bower_components/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('Adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    {{-- Validate Form using javascript --}}
    {{-- <script src="{{ asset('js/validate.min.js')}}"></script> --}}
    @stack('script')
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLte/dist/js/adminlte.min.js')}}"></script>
    <script>
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function () {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
        $('div.alert').not('.alert-important').delay(1000).fadeOut(500);
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>

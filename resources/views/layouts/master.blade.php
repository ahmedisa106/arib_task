<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Arib</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('inc.css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('inc.header')
    <!-- Left side column. contains the logo and sidebar -->

    @if(auth('admin')->check())
        @include('inc.admin_aside')
    @elseif(auth('manager')->check())
        @include('inc.manager_aside')
    @else
        @include('inc.employee_aside')
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('breadcrumb')
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('inc.footer')

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>


</div>
<!-- ./wrapper -->
@include('inc.js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Epigra Project</title>
    <!-- Bootstrap -->
    <link href="/panel/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/panel/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/panel/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/panel/build/css/custom.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/panel/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="/panel/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="/panel/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="/panel/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="/panel/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <link href="/css/sweetalert2.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/panel/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/panel/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/panel/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/panel/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/panel/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    @yield('css')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><span>Epigra Project</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_info">
                        <h2>Samet Şahindoğan</h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /menu profile quick info -->
                <br/>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li><a href="{{ route('getPosts') }}"><i class="fa fa-edit"></i> Posts</a></li>
                            <li><a href="{{ route('getTags') }}"><i class="fa fa-tag"></i> Tags</a></li>
                            <li><a href="{{ route('getCategories') }}"><i class="fa fa-align-justify"></i> Categories</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>
    @yield('content')
    <!-- footer content -->
        <footer>
            <div class="pull-right">
                Epigra - This is an interview project. Written by <a href="https://linkedin.com/in/sametsahindogan">Samet</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<!-- jQuery -->
<script src="/panel/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/panel/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/panel/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/panel/vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="/panel/build/js/custom.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')
</body>
</html>

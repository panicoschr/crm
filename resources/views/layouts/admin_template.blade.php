<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mini-CRM | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="admin-lte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="admin-lte/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="admin-lte/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="admin-lte/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="admin-lte/plugins/summernote/summernote-bs4.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
        
        @yield('style')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/home" class="nav-link">Home</a>
                    </li>

                </ul>



                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/home" class="brand-link">
                    <img src="admin-lte/dist/img/MiniCrmLogo.png" alt="MiniCrm Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">mini-CRM</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="admin-lte/dist/img/logged-in-user.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ $name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                         {{ trans('sentence.dashboard')}}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/home" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v1</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    @php $locale = session()->get('locale'); @endphp 
                                    <p>
                                        {{ trans('sentence.language')}}  
                                        @switch($locale)
                                        @case('fr')
                                        <img src="{{asset('img/fr.png')}}" width="30px" height="20x">
                                        @break
                                        @default
                                        <img src="{{asset('img/uk.png')}}" width="30px" height="20x">
                                        @endswitch
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="lang/en" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> English <img src="{{asset('img/uk.png')}}" width="30px" height="20x"> </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="lang/fr" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> French  <img src="{{asset('img/fr.png')}}" width="30px" height="20x"> </p>
                                        </a>
                                    </li>
                                </ul>              

                            </li>       


                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                         {{ trans('sentence.layoutoptions')}}
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/layout/top-nav.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Top Navigation</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/layout/boxed.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Boxed</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/layout/fixed-sidebar.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fixed Sidebar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/layout/fixed-topnav.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fixed Navbar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/layout/fixed-footer.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fixed Footer</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/layout/collapsed-sidebar.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Collapsed Sidebar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tree"></i>
                                    <p>
                            {{ trans('sentence.uielements')}}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/general.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>General</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/icons.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Icons</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/buttons.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Buttons</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/sliders.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Sliders</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/modals.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Modals & Alerts</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/navbar.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Navbar & Tabs</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/timeline.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Timeline</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-lte/pages/UI/ribbons.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ribbons</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        {{ trans('sentence.tables')}}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/ajax" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ trans('sentence.userinforender')}}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/datatable" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ trans('sentence.userinfonorender')}}</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-header">ADMIN</li>
                            <li class="nav-item">
                                <a href="/adminapi" class="nav-link">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        {{ trans('sentence.adminpanel')}}
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                            </li>  
                            <li class="nav-header">{{ trans('sentence.logout')}}</li>                            
                            <li class="nav-item">
                                <a href="/logoutuser" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        {{ trans('sentence.logout')}}
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                            </li>                              
     

     
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">mini-CRM Dashboard</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="\home">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard v1</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    
         @yield('content')      
                    
                    <div class="container-fluid">

                 
                        
                        
                        
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.0-rc.1
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="admin-lte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="admin-lte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="admin-lte/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="admin-lte/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="admin-lte/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="admin-lte/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="admin-lte/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="admin-lte/plugins/moment/moment.min.js"></script>
        <script src="admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="admin-lte/dist/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="admin-lte/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="admin-lte/dist/js/demo.js"></script>
    </body>
    
    @yield('javascripts')
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mini-CRM</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../admin-lte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="../admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="../admin-lte/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../admin-lte/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../admin-lte/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="../admin-lte/plugins/summernote/summernote-bs4.css">
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
                        <a class="nav-link" data-widget="pushmenu" href="/home"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/home" class="nav-link">Home</a>
                    </li>

                </ul>
                <!-- Right navbar links -->

            </nav>


            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/home" class="brand-link">
                    <img src="../admin-lte/dist/img/MiniCrmLogo.png" alt="MiniCrm Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">mini-CRM</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('img/logged-in-user.png')}}" width="30px" height="20x" class="img-circle elevation-2" alt="User Image">                            
                        </div>
                        <div class="info">
                            <a href="/home" class="d-block">{{ $name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview">
                                <a href="/home" class="nav-link">
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
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        {{ trans('sentence.reports')}}
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
                                        <a href="/datatable/all" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ trans('sentence.userinfonorender')}}</p>
                                        </a>
                                    </li>
                                </ul>
                         </li>
                         @if (auth()->user()->isadmin())  
               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
             {{ trans('sentence.adminpanel')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/apisedit" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('sentence.apimanagement')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/datatable/employee" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                 <p>{{ trans('sentence.employees')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/datatable/company" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
               <p>{{ trans('sentence.companies')}}</p>
                </a>
              </li>
            </ul>
          </li>
         @endif  
                         
                         
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

                </div>
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">

                </div>

                <section class="content">
                    
         @yield('content')      
                    
                    <div class="container-fluid">

                          
                    </div><!-- /.container-fluid -->
                </section>
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
        <script src="../admin-lte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="../admin-lte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="../admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="../admin-lte/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="../admin-lte/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="../admin-lte/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="../admin-lte/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../admin-lte/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="../admin-lte/plugins/moment/moment.min.js"></script>
        <script src="../admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="../admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="../admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="../admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="../admin-lte/dist/js/adminlte.js"></script>
   </body>
    @yield('javascripts')
</html>

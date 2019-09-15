<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
<span class="input-group-btn">
  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
</span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
             <!-- Optionally, you can add icons to the links -->
            <li class="treeview active">
                <a href="/home"><span>Mini-CRM Menu</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="treeview active">
                        <a href="/employees"><span>{{ trans('sentence.employees')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/employees/create">{{ trans('sentence.newemp')}}</a></li>
                        </ul>
                    </li>     
                    <li class="treeview active">
                        <a href="/companies"><span>{{ trans('sentence.companies')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/companies/create">{{ trans('sentence.newcomp')}}</a></li>
                        </ul>
                    </li>                          
                    <li class="treeview active"><a href="/adminapi">{{ trans('sentence.adminpanel')}}</a></li>    
                      <li class="treeview active">
                        <a href="/home"><span>{{ trans('sentence.userinfo')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/datatable">{{ trans('sentence.userinfonorender')}}</a></li>
                             <li><a href="/ajax">{{ trans('sentence.userinforender')}}</a></li>
                        </ul>
                    </li>   
                    <li class="treeview active"><a href="/logoutUser">{{ trans('sentence.logout')}}</a></li>                        
                    
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('assets')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth('admin')->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li><a href="{{route('admin.home')}}"><i class="fa fa-home text-aqua"></i> <span>Home</span></a></li>
            <li><a href="{{route('admin.managers.index')}}"><i class="fa fa-user-circle text-aqua"></i> <span>Managers</span></a></li>
            <li><a href="{{route('admin.departments.index')}}"><i class="fa fa-home text-aqua"></i> <span>Departments</span></a></li>
            <li><a href="{{route('admin.employees.index')}}"><i class="fa fa-users text-aqua"></i> <span>Employees</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

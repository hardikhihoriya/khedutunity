<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('css/admin/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><a href="#">{{ucfirst(Auth::user()->name)}}</a></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><center>Dashboard</center></li>
            <li class="{{ (Request::is('admin/create-user') || Request::is('admin/list-user')) ? 'active treeview' : 'treeview' }}">
                <a href="{{url('admin/users')}}">
                    <i class="fa fa-dashboard"></i> <span>User Management</span>                    
                </a>                
            </li>
            <li class="{{ (Request::is('admin/district')) || Request::is('admin/taluka') || Request::is('admin/add-district') || Request::is('admin/add-taluka') ? 'active treeview' : 'treeview' }}">
                <a href="{{url('admin/district')}}">
                    <i class="fa fa-diamond"></i>
                    <span>
                        Gujarat Details
                    </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/district') || Request::is('admin/add-district') ? 'active' : '' }}">
                        <a href="{{url('admin/district')}}"><i class="fa fa-circle-o"></i> District Management </a>
                    </li>
                    <li class="{{ Request::is('admin/taluka') || Request::is('admin/add-taluka') ? 'active' : '' }}">
                        <a href="{{url('admin/taluka')}}"><i class="fa fa-circle-o"></i> Taluka Management </a>
                    </li>
                </ul>
            </li>
            <li class="{{ (Request::is('admin/create-user') || Request::is('admin/list-user')) ? 'active treeview' : 'treeview' }}">
                <a href="{{url('admin/blank-land')}}">
                    <i class="fa fa-dashboard"></i> <span>Blank Land</span>                    
                </a>
            </li>

        </ul>
    </section>
</aside>
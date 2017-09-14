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
                    <!--<span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>-->
                </a>                
                <!--<ul class="treeview-menu">
                   <li class="{{ Request::is('admin/add-user') ? 'active' : '' }}"><a href="{{url('admin/add-user')}}"><i class="fa fa-circle-o"></i>Create User</a></li>
                   <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{url('admin/users')}}"><i class="fa fa-circle-o"></i> List Users</a></li>
                 </ul>-->
            </li>
            <li class="{{ (Request::is('admin/create-user') || Request::is('admin/list-user')) ? 'active treeview' : 'treeview' }}">
                <a href="{{url('admin/district')}}">
                    <i class="fa fa-dashboard"></i> <span>Gujarat District</span>                    
                </a>
            </li>
            <li class="{{ (Request::is('admin/create-user') || Request::is('admin/list-user')) ? 'active treeview' : 'treeview' }}">
                <a href="{{url('admin/blank-land')}}">
                    <i class="fa fa-dashboard"></i> <span>Blank Land</span>                    
                </a>
            </li>
            
        </ul>
    </section>
</aside>
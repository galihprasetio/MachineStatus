<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('AdminLte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> --}}

      <!-- search form (Optional) -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Navigation</li>
          <!-- Optionally, you can add icons to the links -->
          {{-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
          <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
          
         
        <li class="treeview">
          <a href="#"><i class="fa fa-folder-o"></i> <span>Machine Status</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="item {{active_route('printer.index')}}"><a href="{{ route('printer.index')}}">Device Printer</a></li>
            <li class="item {{active_route('scanner.index')}}"><a href="{{ route('scanner.index')}}">Device Scanner</a></li>
            <li class="item {{active_route('hmi.index')}}"><a href="{{ route('hmi.index')}}">Device HMI</a></li>
            <li class="item {{active_route('nmp.index')}}"><a href="{{ route('nmp.index')}}">Device NMP</a></li>
            <li class="item {{active_route('device.index')}}"><a href="{{ route('device.index')}}">NMP Room</a></li>
            
          </ul>
          
        </li>
        <li class="header">User Management</li>
        <!-- Optionally, you can add icons to the links -->
        {{-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Access Control List</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li class="item {{active_route('users.index')}}"><a href="{{ route('users.index')}}">Users</a></li>
            <li class="item {{active_route('roles.index')}}"><a href="{{route('roles.index')}}">Roles</a></li>
            <li class="item {{active_route('department.index')}}"><a href="{{ route('department.index')}}"> Department</a></li>
            <li class="item "{{active_route('section.index')}}><a href="{{route('section.index')}}"> Section</a></li>
          
          </ul>
          
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
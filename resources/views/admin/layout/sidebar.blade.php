  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div class="user-details">
                <div class="pull-left">
                    <img src="{{asset("admin")}}/images/logo.png" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ config('app.name')}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="md md-settings"></i> Reset Profile</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="md md-administrators-power"></i> Logout</a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </ul>
                    </div>

                    <p class="text-muted m-0">Admin</p>
                </div>
            </div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li>
                    <a href="{{ route("dashboard")}}" class="waves-effect {{set_Topmenu("dashboard")}}"><i class="md md-home"></i><span> Dashboard </span></a>
                    </li>
                    @if (hasActive("supplier") &&hasPermission("supplier", VIEW))
                    <li>
                        <a href="{{ route("supplier")}}" class="waves-effect {{set_Topmenu("supplier")}}"><i class="md md-dashboard"></i><span> Supplier </span></a>
                    </li>
                    @endif
                    @if (hasActive("category") &&hasPermission("category", VIEW))
                    <li>
                        <a href="{{ route("category")}}" class="waves-effect {{set_Topmenu("category")}}"><i class="md md-dashboard"></i><span> Category </span></a>
                    </li>
                    @endif
                    @if (hasActive("product") && hasPermission("product", VIEW))
                    <li>
                        <a href="{{ route("product")}}" class="waves-effect {{set_Topmenu("product")}}"><i class="md md-dashboard"></i><span> Product </span></a>
                    </li>
                    @endif
                    @if (hasActive("product_store") && hasPermission("product", VIEW))
                    <li>
                        <a href="{{ route("store")}}" class="waves-effect {{set_Topmenu("product_store")}}"><i class="md md-dashboard"></i><span> Product Store </span></a>
                    </li>
                    @endif
                    @if (hasActive("administrator") && hasPermission("administrator", VIEW))
                    <li class="has_sub">
                        <a href="#" class="waves-effect <?php echo set_Topmenu("administrator"); ?>"><i class="ion ion-android-sort"></i><span>Administrator </span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            @if(is_super_admin())
                                <li class="{{set_Submenu("module")}}"><a href="{{url("module")}}">Module</a></li>
                            @endif
                            @if (hasPermission("role_permission", VIEW))
                                <li class="{{set_Submenu("role-permission")}}"><a href="{{route("role")}}">Role Permission</a></li>
                             @endif
                              @if (hasPermission("manage_user", VIEW))
                                <li class="{{set_Submenu("manage-user")}}"><a href="{{route("users")}}">Manage User</a></li>
                              @endif
                        </ul>
                    </li>
                    @endif
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->

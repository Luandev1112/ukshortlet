<div class="sidebar capsule--rounded bg_img overlay--dark"
     data-background="{{asset('assets/admin/images/sidebar/2.jpg')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="image"></a>
            <a href="{{route('admin.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="image"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('admin.inventories')}}">
                    <a href="{{route('admin.inventories')}}" class="nav-link a_parameter_setting">
                        <i class="menu-icon las la-tree"></i>
                        <span class="menu-title">Manage Inventories</span>
                    </a>
                </li>

                 <li class="sidebar-menu-item">
                    <a data-toggle="modal" data-target="#parameterModal" href="#parameterModal" class="nav-link a_parameter_setting" >
                        <i class="menu-icon las la-tree"></i>
                        <span class="menu-title">Parameter Input</span>
                    </a>
                </li>
                
            </ul>
        
        </div>
    </div>
</div>
<!-- sidebar end -->

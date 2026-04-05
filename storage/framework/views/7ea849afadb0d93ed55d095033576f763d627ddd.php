<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="<?php echo e(url('/administrator/dashboard')); ?>">
                    <!-- <img class="brand-img" src="<?php echo e(URL::asset('front')); ?>/assets/images/logo.png" alt="logo" style="width: 45px;"/> -->
                  <!-- <span class="brand-text">Playonlineds</span>   -->
                  <img class="brand-img" src="<?php echo e(URL::asset('front')); ?>/assets/images/logo.png" alt="logo" style="width:110px; height:60px;    border-radius: 8px;"/>
                </a>
            </div>
        </div>
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                    <img src="<?php echo e(asset('/backend/img/default_aa.jpg')); ?>" alt="user_image" class="user-auth-img img-circle"/>
                    <span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    
                    <li>
                        <a href="<?php echo e(route('admin_change_pass')); ?>"><i class="zmdi zmdi-account"></i><span>Change Password</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo e(route('admin_logout')); ?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH /home/playon/admin/resources/views/administrator/includes/header.blade.php ENDPATH**/ ?>
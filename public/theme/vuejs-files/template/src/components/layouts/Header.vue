<template>
    <!-- Header -->
        <div class="header">
        
            <!-- Logo -->
            <div class="header-left">
                <router-link to="/" class="logo">
                    <img src="../../assets/img/logo.png" alt="Logo">
                </router-link>
                <router-link to="/" class="logo logo-small">
                    <img src="../../assets/img/logo-small.png" alt="Logo" width="30" height="30">
                </router-link>
            </div>
            <!-- /Logo -->
            
            <!-- Sidebar Toggle -->
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
            <!-- /Sidebar Toggle -->
            
            <!-- Search -->
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <!-- /Search -->
            
            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->
            
            <!-- Header Menu -->
                <ul class="nav nav-tabs user-menu">
                    <!-- Flag -->
                    <li class="nav-item dropdown has-arrow flag-nav">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                            <img src="../../assets/img/flags/us.png" alt="" height="20"> <span class="adminmodule">English</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../../assets/img/flags/us.png" alt="" height="16"> English
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../../assets/img/flags/fr.png" alt="" height="16"> French
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../../assets/img/flags/es.png" alt="" height="16"> Spanish
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../../assets/img/flags/de.png" alt="" height="16"> German
                            </a>
                        </div>
                    </li>
                    <!-- /Flag -->
                    
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <i data-feather="bell"></i> <span class="badge rounded-pill">5</span>
                        </a>
                        <div class="dropdown-menu notifications">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                                <a href="javascript:void(0)" class="clear-noti"> Clear All</a>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <li class="notification-message">
                                        <router-link to="/activities">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" alt="" src="../../assets/img/profiles/avatar-02.jpg">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">Brian Johnson</span> paid the invoice <span class="noti-title">#DF65485</span></p>
                                                    <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </li>
                                    <li class="notification-message">
                                        <router-link to="/activities">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" alt="" src="../../assets/img/profiles/avatar-03.jpg">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">Marie Canales</span> has accepted your estimate <span class="noti-title">#GTR458789</span></p>
                                                    <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </li>
                                    <li class="notification-message">
                                        <router-link to="/activities">
                                            <div class="media d-flex">
                                                <div class="avatar avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary-light"><i class="far fa-user"></i></span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">New user registered</span></p>
                                                    <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </li>
                                    <li class="notification-message">
                                        <router-link to="/activities">
                                            <div class="media d-flex">
                                                <span class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" alt="" src="../../assets/img/profiles/avatar-04.jpg">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">Barbara Moore</span> declined the invoice <span class="noti-title">#RDW026896</span></p>
                                                    <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </li>
                                    <li class="notification-message">
                                        <router-link to="/activities">
                                            <div class="media d-flex">
                                                <div class="avatar avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-info-light"><i class="far fa-comment"></i></span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">You have received a new message</span></p>
                                                    <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                            <div class="topnav-dropdown-footer">
                                <router-link to="/activities">View all Notifications</router-link>
                            </div>
                        </div>
                    </li>
                    <!-- /Notifications -->
                    
                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow main-drop">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img src="../../assets/img/profiles/avatar-01.jpg" alt="">
                                <span class="status online"></span>
                            </span>
                        <span class="adminmodule"> Admin</span>
                        </a>
                        <div class="dropdown-menu">
                            <router-link class="dropdown-item" to="/profile"><i data-feather="user" class="me-1"></i> Profile</router-link>
                            <router-link class="dropdown-item" to="/settings"><i data-feather="settings" class="me-1"></i> Settings</router-link>
                            <router-link class="dropdown-item" to="/login"><i data-feather="log-out" class="me-1"></i> Logout</router-link>
                        </div>
                    </li>
                    <!-- /User Menu -->
                    
                </ul>
                <!-- /Header Menu -->
            
        </div>
    <!-- /Header -->
</template>

<script>

export default {
    components: {
        
    },
    mounted() {
         var $wrapper = $('.main-wrapper');
         var $pageWrapper = $('.page-wrapper');
    var $slimScrolls = $('.slimscroll');

    // Mobile menu sidebar overlay
    $('body').append('<div class="sidebar-overlay"></div>');
    $(document).on('click', '#mobile_btn', function () {
        $wrapper.toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
        $('html').addClass('menu-opened');
        return false;
    });
    
    // Sidebar overlay
    $(".sidebar-overlay").on("click", function () {
        $wrapper.removeClass('slide-nav');
        $(".sidebar-overlay").removeClass("opened");
        $('html').removeClass('menu-opened');
    });
    
    // Page Content Height
    if ($('.page-wrapper').length > 0) {
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }
    
    // Page Content Height Resize
    $(window).resize(function () {
        if ($('.page-wrapper').length > 0) {
            var height = $(window).height();
            $(".page-wrapper").css("min-height", height);
        }
    });
 
       
        // $('body').append('<div class="sidebar-overlay"></div>');
        // $(document).on('click', '#mobile_btn', function() {
        //     $wrapper.toggleClass('slide-nav');
        //     $('.sidebar-overlay').toggleClass('opened');
        //     $('html').addClass('menu-opened');
        //     $('#task_window').removeClass('opened');
        //     return false;
        // });
        // Small Sidebar
    

       

        $(document).on('click', '.top-nav-search .responsive-search', function() {
            $('.top-nav-search').toggleClass('active');
        });
        // $('.sidebar-menu ul li:not(.submenu) a').click(function () {
        //     $("html").removeClass('menu-opened');
        //     $(".sidebar-overlay").removeClass('opened');
        // });
    }
}
</script>
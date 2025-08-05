
<!-- DEBUG-VIEW START 8 APPPATH/Views/lib/bot_poc.php -->
<!DOCTYPE html>
<html lang="en">

<head>
<script type="text/javascript"  id="debugbar_loader" data-time="1627188447" src="https://www.canopuz.com?debugbar"></script><script type="text/javascript"  id="debugbar_dynamic_script"></script><style type="text/css"  id="debugbar_dynamic_style"></style>

    <!-- DEBUG-VIEW START 1 APPPATH/Views/common/html_head.php -->
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="Venera CMS, Common solution for a company" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>Venera</title>

<link rel="icon" href="https://www.canopuz.com/cms/public/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="https://www.canopuz.com/cms/public/theme/oct/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://www.canopuz.com/cms/public/theme/oct/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://www.canopuz.com/cms/public/theme/oct/img/favicon/favicon-16x16.png">
<link rel="manifest" href="https://www.canopuz.com/cms/public/theme/oct/img/favicon/manifest.json">
<link rel="mask-icon" href="https://www.canopuz.com/cms/public/theme/oct/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">



<!-- Global site tag (gtag.js) - Google Analytics -->
<!--https://developers.google.com/analytics/devguides/collection/gtagjs/custom-dims-mets-->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FMV6D43RVR"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-FMV6D43RVR', {
    'linker': {
        'domains': ['canopuz.com']
    }
    ,'user_id': 'canopus'});

// Maps 'dimension1' to 'user'.
gtag('config', 'G-FMV6D43RVR', {
    'custom_map': {'dimension1': 'user'}
});

// Sends an event that passes 'age' as a parameter.
gtag('event', 'user_dimension', {'user': 'canopus'});
</script>
<!-- DEBUG-VIEW ENDED 1 APPPATH/Views/common/html_head.php -->

    <link rel="stylesheet" href="https://www.canopuz.com/cms/public/theme/bot/style.css">
    <!-- fonts -->
    <link rel="stylesheet" href="https://www.canopuz.com/cms/public/theme/oct/fonts/md-fonts/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://www.canopuz.com/cms/public/theme/oct/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="https://www.canopuz.com/cms/public/theme/oct/libs/animate.css/animate.min.css">

    <!-- jquery-loading -->
    <link rel="stylesheet" href="https://www.canopuz.com/cms/public/theme/oct/libs/jquery-loading/dist/jquery.loading.min.css">
    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="https://www.canopuz.com/cms/public/theme/oct/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed">
<!-- DEBUG-VIEW START 2 APPPATH/Views/common/header.php -->
    <header class="app-header navbar">
        <div class="hamburger hamburger--arrowalt-r navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
        <!-- end hamburger -->
        <a class="navbar-brand" href="https://www.canopuz.com/cms/public">
            <strong>Venera</strong>
        </a>

        <div class="hamburger hamburger--arrowalt-r navbar-toggler sidebar-toggler d-md-down-none mr-auto">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
        <!-- end hamburger -->

        <div class="navbar-search">
            <button type="submit" class="navbar-search-btn">
                <i class="mdi mdi-magnify"></i>
            </button>
            <input type="text" class="navbar-search-input" placeholder="Find User a user, team, meeting ..">
        </div>
        <!-- end navbar-search -->

        <ul class="nav navbar-nav ">
            <li class="nav-item dropdown">
                <a class="nav-link " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-ring"></i>
                    <span class="notification hertbit"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right notification-list animated flipInY nicescroll-box">

                    <div class="dropdown-header">
                        <strong>Notification</strong>
                        <span class="badge badge-pill badge-theme pull-right"> new 5</span>
                    </div>
                    <!--end dropdown-header -->

                    <div class="wrap">

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>A New Order has Been Placed </strong>
                                    </div>
                                    <small>2 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                </div>
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>Order Updated</strong>
                                    </div>
                                    <small>10 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>A New Order has Been Placed </strong>
                                    </div>
                                    <small>30 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown -->

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong> Order has Been Rated </strong>
                                    </div>
                                    <small>32 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown -->
                    </div>
                    <!-- end wrap -->

                    <div class="dropdown-footer ">
                        <a href="">
                            <strong>See all messages (150) </strong>
                        </a>
                    </div>
                    <!-- end dropdown-footer -->
                </div>
                <!-- end notification-list -->

            </li>
            <!-- end nav-item -->

            <li class="nav-item ">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-forum"></i>
                    <span class="notification hertbit"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right message-list animated flipInY nicescroll-box">

                    <div class="dropdown-header">
                        <strong>Messages</strong>
                        <span class="badge badge-pill badge-theme pull-right"> new 15</span>
                    </div>
                    <!-- end dropdown-header -->
                    <div class="wrap">

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                    <span class="notification online"></span>
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>Natalie Wall</strong>
                                    </div>
                                    <p class="text-muted">Anyways i would like just do it</p>
                                    <small>2 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                    <span class="notification offline"></span>
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>Steve johns</strong>
                                    </div>
                                    <p class="text-muted">There is Problem inside the Application</p>
                                    <small>10 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                    <span class="notification buzy"></span>
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>Taniya Jan</strong>
                                    </div>
                                    <p class="text-muted">Please Checkout The Attachment</p>
                                    <small>30 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <div class="message-box">
                                <div class="u-img">
                                    <img src="http://via.placeholder.com/100x100" alt="user" />
                                    <span class="notification away"></span>
                                </div>
                                <!-- end u-img -->
                                <div class="u-text">
                                    <div class="u-name">
                                        <strong>Tim Johns</strong>
                                    </div>
                                    <!-- end u-name -->
                                    <p class="text-muted">Anyways i would like just do it</p>
                                    <small>32 minuts ago</small>
                                </div>
                                <!-- end u-text -->
                            </div>
                            <!-- end message-box -->
                        </a>
                        <!-- end dropdown-item -->
                    </div>
                    <!-- end wrap -->
                    <div class="dropdown-footer ">
                        <a href="">
                            <strong>See all messages (150) </strong>
                        </a>
                    </div>
                    <!-- end dropdown-footer -->
                </div>
                <!-- end message-list -->
            </li>
            <!-- end nav-item -->


            <li class="nav-item ">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-cards"></i>
                    <span class="notification hertbit"></span>
                </a>
                <!-- end navlink -->
                <div class="dropdown-menu dropdown-menu-right task-list animated flipInY nicescroll-box">

                    <div class="dropdown-header">
                        <strong>Task List</strong>
                        <span class="badge badge-pill badge-theme pull-right"> new 3</span>
                    </div>
                    <!-- end dropdown-header -->
                    <div class="wrap">
                        <a href="#" class="dropdown-item">
                            <strong>Task 1</strong>
                            <small class="pull-right">50% Complete</small>
                            <div class="progress xs">
                                <div class="progress-bar bg-danger" style="width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                </div>
                            </div>
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <strong>Task 2</strong>
                            <small class="pull-right">20% Complete</small>

                            <div class="progress xs">
                                <div class="progress-bar bg-success" style="width: 20%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                </div>
                            </div>
                        </a>

                        <!-- end dropdown-item -->
                        <a href="#" class="dropdown-item">
                            <strong>Task 3</strong>
                            <small class="pull-right">80% Complete</small>

                            <div class="progress xs ">
                                <div class="progress-bar bg-warning" style="width: 80%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                </div>
                            </div>
                        </a>
                        <!-- end dropdown-item -->

                        <a href="#" class="dropdown-item">
                            <strong>Task 4</strong>
                            <small class="pull-right">60% Complete</small>

                            <div class="progress xs ">
                                <div class="progress-bar bg-info" style="width: 60%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                </div>
                            </div>
                        </a>
                        <!-- end dropdown-item -->
                    </div>
                    <!-- end wrap -->
                    <div class="dropdown-footer ">
                        <a href="">
                            <strong>view all task (20) </strong>
                        </a>
                    </div>
                    <!-- end dropdown-footer -->

                </div>
                <!-- dropdown-menu -->
            </li>
            <!-- end navitem -->

            <li class="nav-item dropdown">
                <a class="btn btn-round btn-theme btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

                    <span class="">Sugunan                        <i class="fa fa-arrow-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right user-menu animated flipInY ">
                    <div class="wrap">
                        <div class="dw-user-box">
                            <div class="u-img">
                                <img src="https://lh3.googleusercontent.com/a-/AOh14GhvMXenYyq8RwvDt5HewY9WnC-0gKDdeEHG_p2P1Q=s96-c" alt="Sugunan" />
                            </div>
                            <div class="u-text">
                                <h5>Sugunan</h5>
                                <p class="text-muted">zugunan@gmail.com</p>
                                <a target="_blank" href="https://www.canopuz.com/wp-admin/profile.php" class="btn btn-round btn-theme btn-sm">View Profile</a>
                            </div>
                        </div>
                        <!-- end dw-user-box -->

                        <a class="dropdown-item" target="_blank" href="https://www.canopuz.com/wp-admin/profile.php">
                            <i class="fa fa-user"></i> Profile</a>
                        <a class="dropdown-item" target="_blank" href="https://www.canopuz.com/wp-admin/profile.php">
                            <i class="fa fa-wrench"></i> Settings</a>

                        <div class="divider"></div>

                        <a class="dropdown-item" href="https://www.canopuz.com/signin2/?action=logout&amp;_wpnonce=169de5974f">
                            <i class="fa fa-lock"></i> Logout</a>
                    </div>
                    <!-- end wrap -->
                </div>
                <!-- end dropdown-menu -->
            </li>
            <!-- end nav-item -->


        </ul>

        <div class="hamburger hamburger--arrowalt-r navbar-toggler aside-menu-toggler ">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </header>
<!-- DEBUG-VIEW ENDED 2 APPPATH/Views/common/header.php -->
    <!-- end header -->

    <div class="app-body">
        <div class="sidebar" id="sidebar">
            <!-- DEBUG-VIEW START 3 APPPATH/Views/common/left_bar.php -->
            <nav class="sidebar-nav" id="sidebar-nav-scroller">
                <ul class="nav">                   

                    <li class="nav-title">Apps</li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="mdi mdi-cash-multiple"></i> Finance
                        </a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.canopuz.com/cms/public/account/list_all"> Manage Accounts</a>
                            </li>
                                                    </ul>
                    </li>
                    <!--<li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="mdi mdi-store"></i> Inventory
                        </a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.canopuz.com/cms/public/inventory/list_all"> Manage Inventory</a>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </nav>
<!-- DEBUG-VIEW ENDED 3 APPPATH/Views/common/left_bar.php -->
        </div>
        <!-- end sidebar -->

        <main class="main">
            <!-- Breadcrumb -->
            <!-- DEBUG-VIEW START 4 APPPATH/Views/common/breadcrumb.php -->

<!-- DEBUG-VIEW ENDED 4 APPPATH/Views/common/breadcrumb.php -->

            <div class="container-fluid">

                <div class="animated fadeIn">   

                    <div class="col-md-12">
                        <div class="clearfix">
                            <div class="float-left">
                                <h3 class="text-theme">Account</h3>
                                <p>Account will group the transactions based on financial year and group.</p>
                            </div>
                            <!-- float-left -->
                                                        <div class="float-right">
                                <a href="https://www.canopuz.com/cms/public/account/add_edit/1/1" class="btn btn-danger btn-round">
                                    <i class="mdi mdi-lock-open"></i> UNLOCK</a>
                            </div>
                              
                        </div>
                                                <form method="post" action="#" enctype="multipart/form-data" id="needs-validation" novalidate>
                            
                            <input name="csrf" value="1" type="hidden">
                            <div class="card card-accent-theme">
                                <div class="card-header text-theme">
                                    <strong>Account</strong>
                                    Detail
                                </div>    
                                <div class="card-body">
                                                                        
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                                                                        <label for="validationCustom1">Account label</label>
                                            <input name="label" value="" type="text" class="form-control" id="validationCustom2" placeholder="Account label">
                                            
                                        </div>
                                        <div class="col-md-6 mb-3">
                                                                                        <label for="validationCustom1">Currency symbol</label>
                                            <input name="currency_symbol" value="" type="text" class="form-control" id="validationCustom2" placeholder="Rs.">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                                                                        <label for="validationCustom1">Financial year start</label>
                                            <input name="fy_start" value="" type="text" class="fy_start form-control" id="validationCustom2" placeholder="2021-04-01">
                                            
                                        </div>
                                        <div class="col-md-6 mb-3">
                                                                                        <label for="validationCustom1">Financial year end</label>
                                            <input name="fy_end" value="" type="text" class="fy_end form-control" id="validationCustom2" placeholder="2022-03-31">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                                                                        <label for="validationCustom1">Date format</label>
                                            <select name="date_format" class="form-control select2" data-plugin="select2" id="validationCustom2">
                                                <option value="">--Select--</option>
                                                
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-6 mb-3">
                                                                                        <label for="validationCustom1">Status</label>
                                            <select name="status" class="form-control select2" data-plugin="select2" id="validationCustom2">
                                                <option value="">--Select--</option>
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="text-theme">Grant access</h6>
                                    <small>Select the users whom you want to manage this account</small>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                                                                                                                    <label for="validationCustom1">Users</label>
                                            <select name="users[]" class="form-control select2" data-plugin="select2" multiple>
                                               
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>                                
                                <!-- end card-body -->
                                <div class="card-footer">
                                                                            <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                                        <button type="reset" class="btn btn-sm btn-danger">
                                            <i class="fa fa-ban"></i> Reset</button>
                                                                    </div>
                            </div>
                            <!-- end card -->
                                                </form> 
                                                   
                    </div>                        
                    <!-- end col -->
                </div>
                <!-- end animated fadeIn -->
            </div>
            <br>
            <!-- end container-fluid -->
        </main>
        <!-- end main -->
        
            <!-- DEBUG-VIEW START 5 APPPATH/Views/common/aside.php -->
        <aside class="aside-menu">
                <div class="aside-header bg-theme text-uppercase">Service Panel</div>
                <div class="aside-body">
                    <h6 class="text-theme">Light Sidebar</h6>
                    <ul class="theme-colors">
                        <li class="theme-blue" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-blue.css')"></li>
                        <li class="theme-green" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-green.css')"></li>
                        <li class="theme-red" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-red.css')"></li>
                        <li class="theme-yellow" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-yellow.css')"></li>
                        <li class="theme-orange" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-orange.css')"></li>
                        <li class="theme-teal" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-teal.css')"></li>
                        <li class="theme-cyan" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-cyan.css')"></li>
                        <li class="theme-purple" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-purple.css')"></li>
                        <li class="theme-indigo" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-indigo.css')"></li>
                        <li class="theme-pink" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-pink.css')"></li>
                    </ul>
    
                    <!-- <h6 class="text-theme">Social Colors</h6> -->
                    <ul class="theme-colors">
                        <li class="theme-facebook" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-facebook.css')"></li>
                        <li class="theme-twitter" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-twitter.css')"></li>
                        <li class="theme-linkedin" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-linkedin.css')"></li>
                        <li class="theme-google-plus" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-google-plus.css')"></li>
                        <li class="theme-flickr" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-flickr.css')"></li>
                        <li class="theme-tumblr" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-tumblr.css')"></li>
                        <li class="theme-xing" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-xing.css')"></li>
                        <li class="theme-github" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-github.css')"></li>
                        <li class="theme-html5" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-html5.css')"></li>
                        <li class="theme-openid" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-openid.css')"></li>
                        <li class="theme-stack-overflow" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-stack-overflow.css')"></li>
                        <li class="theme-css3" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-css3.css')"></li>
                        <li class="theme-dribbble" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-dribbble.css')"></li>
                        <li class="theme-instagram" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-instagram.css')"></li>
                        <li class="theme-pinterest" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-pinterest.css')"></li>
                        <li class="theme-vk" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-vk.css')"></li>
                        <li class="theme-yahoo" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-yahoo.css')"></li>
                        <li class="theme-behance" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-behance.css')"></li>
                        <li class="theme-dropbox" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-dropbox.css')"></li>
                        <li class="theme-reddit" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-reddit.css')"></li>
                        <li class="theme-spotify" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-spotify.css')"></li>
                        <li class="theme-vine" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-vine.css')"></li>
                        <li class="theme-foursquare" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-foursquare.css')"></li>
                        <li class="theme-vimeo" onclick="swapStyleSheet('https://www.canopuz.com/cms/public/theme/oct/css/style-vimeo.css')"></li>
    
                    </ul>
    
                    <h6 class="text-theme">Dark Sidebar</h6>
                    <ul class="theme-colors">
                        <li class="theme-blue" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-blue.css')"></li>
                        <li class="theme-green" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-green.css')"></li>
                        <li class="theme-red" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-red.css')"></li>
                        <li class="theme-yellow" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-yellow.css')"></li>
                        <li class="theme-orange" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-orange.css')"></li>
                        <li class="theme-teal" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-teal.css')"></li>
                        <li class="theme-cyan" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-cyan.css')"></li>
                        <li class="theme-purple" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-purple.css')"></li>
                        <li class="theme-indigo" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-indigo.css')"></li>
                        <li class="theme-pink" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-pink.css')"></li>
                    </ul>
    
                    <!-- <h6 class="text-theme">Social Colors</h6> -->
                    <ul class="theme-colors">
                        <li class="theme-facebook" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-facebook.css')"></li>
                        <li class="theme-twitter" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-twitter.css')"></li>
                        <li class="theme-linkedin" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-linkedin.css')"></li>
                        <li class="theme-google-plus" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-google-plus.css')"></li>
                        <li class="theme-flickr" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-flickr.css')"></li>
                        <li class="theme-tumblr" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-tumblr.css')"></li>
                        <li class="theme-xing" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-xing.css')"></li>
                        <li class="theme-github" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-github.css')"></li>
                        <li class="theme-html5" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-html5.css')"></li>
                        <li class="theme-openid" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-openid.css')"></li>
                        <li class="theme-stack-overflow" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-stack-overflow.css')"></li>
                        <li class="theme-css3" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-css3.css')"></li>
                        <li class="theme-dribbble" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-dribbble.css')"></li>
                        <li class="theme-instagram" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-instagram.css')"></li>
                        <li class="theme-pinterest" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-pinterest.css')"></li>
                        <li class="theme-vk" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-vk.css')"></li>
                        <li class="theme-yahoo" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-yahoo.css')"></li>
                        <li class="theme-behance" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-behance.css')"></li>
                        <li class="theme-dropbox" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-dropbox.css')"></li>
                        <li class="theme-reddit" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-reddit.css')"></li>
                        <li class="theme-spotify" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-spotify.css')"></li>
                        <li class="theme-vine" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-vine.css')"></li>
                        <li class="theme-foursquare" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-foursquare.css')"></li>
                        <li class="theme-vimeo" onclick="swapStyleSheetDark('https://www.canopuz.com/cms/public/theme/oct/css/style-vimeo.css')"></li>
    
                    </ul>
                </div>
    
            </aside>
<!-- DEBUG-VIEW ENDED 5 APPPATH/Views/common/aside.php -->
            <!-- end aside -->
    
        </div>
        <!-- end app-body -->
        
    <!-- DEBUG-VIEW START 6 APPPATH/Views/common/footer.php -->
    <footer class="app-footer">
        <a href="https://www.canopus.lk" class="text-theme">Venera</a> &copy; 2021 Canopus Pvt Ltd.
    </footer>
<!-- DEBUG-VIEW ENDED 6 APPPATH/Views/common/footer.php -->

    <!-- DEBUG-VIEW START 7 APPPATH/Views/common/html_footer.php -->
    <!-- Bootstrap and necessary plugins -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/Bootstrap/bootstrap.min.js"></script>
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/PACE/pace.min.js"></script>
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/chart.js/dist/Chart.min.js"></script>
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/nicescroll/jquery.nicescroll.min.js"></script>


    <!-- jquery-loading -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/jquery-loading/dist/jquery.loading.min.js"></script>
    <!-- octadmin Main Script -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/js/app.js"></script>
    
<script>
// Maps 'metric2' to 'avg_page_load_time'.
gtag('config', 'G-FMV6D43RVR', {
  'custom_map': {'metric2': 'avg_page_load_time'}
});

// Sends an event that passes 'avg_page_load_time' as a parameter.
gtag('event', 'load_time_metric', {'avg_page_load_time': 0});

gtag('config', 'G-FMV6D43RVR', {
   'custom_map': {
     'dimension1': 'user',
     'metric2': 'avg_page_load_time'
   }
});

gtag('event', 'foo', {'user': 'canopus', 'avg_page_load_time': 0});
</script>
<!-- DEBUG-VIEW ENDED 7 APPPATH/Views/common/html_footer.php -->
    
    <!-- bootstrap form validation -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/js/bootstrap-form-validation.js"></script>
    <!-- datepicker -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!--select 2 -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/select2/dist/js/select2.min.js"></script>

    <!--Alertify js -->
    <script src="https://www.canopuz.com/cms/public/theme/oct/libs/Alertify/js/alertify.js"></script>



<div class="chat" style="width:600px;">
  <div class="chat-title">
    <h1>Canopus Assistant</h1>
    <h2>ChatBot</h2>
    <figure class="avatar">
      <img src="<?php echo base_url("/theme/bot/bot-icon.png"); ?>" />
    </figure>
    <h1 class="close-bot">X</h1>
  </div>
  <div class="messages">
    <div class="messages-content">
      <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
        <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
        </div>
      </div>
    </div>
  </div>
  <div class="message-box">
    <textarea type="text" id="bot-input" class="message-input"  style="width:580px;" placeholder="Type message..."></textarea>
  </div>
</div>
<script src="https://sdk.amazonaws.com/js/aws-sdk-2.685.0.min.js"></script>
<script type="text/javascript">
    // Set the focus to the input box
    document.getElementById("bot-input").focus();

    // Initialize the Amazon Cognito credentials provider
    // Provide the region of your AWS account below
    
    AWS.config.region = 'us-east-1'; 
    AWS.config.credentials = new AWS.CognitoIdentityCredentials({ 
        IdentityPoolId: 'us-east-1:319469c3-0aba-4208-bb33-cbb357f20db2',
    });

    var lexruntime = new AWS.LexRuntime();
    var lexUserId = 'CanopusAssistant' + Date.now();
    var sessionAttributes = {};

    function pushChat() {
        var endConversationStatement = "Customer: I have no more questions. Thank you." 
        // If the agent has to send a message, start the message with 'Agent'
        var inputText = document.getElementById('bot-input');
        
        // If the customer has to send a message, start the message with 'Customer'
        if(inputText && inputText.value && inputText.value.trim().length > 0) {
            // disable input to show we're sending it
            var input = inputText.value.trim();
            inputText.locked = true;
            $("#mCSB_1_container").append('<div class="message message-personal new">'+input+'</div>');

            // Send it to the Lex runtime
            // Provide the name of your bot below 
            var params = {
                botAlias: '$LATEST',
                botName: 'CanopusAssistant',
                inputText: input,
                userId: lexUserId,
                sessionAttributes: sessionAttributes
            };
            lexruntime.postText(params, function(err, data) {
                console.log(data);
                $("#mCSB_1_container").append('<div class="message new"><figure class="avatar"><img src="<?php echo base_url("/theme/bot/bot-icon.png"); ?>"></figure>'+data.message+'<div style="background:#7a8e96;padding:3px;">'+JSON.stringify(data.sentimentResponse)+'</div></div>');
                $(".messages-content").animate({ scrollTop: $('.messages-content').prop("scrollHeight")}, 1000);
                $.post( "<?php echo base_url("/ml/log_chat/"); ?>", { question_key: input, response: data.message, bot_name: params.botName, intent: data.intentName, dialog_state: data.dialogState, sentiment_label: data.sentimentResponse.sentimentLabel })
                .done(function( resData ) {
                    console.log( "Logged successfully" );
                });
            });
        }
        // We always cancel form submission
        return false;
    }
</script>
<script>
$(function () {
    $(document).on("keypress", '.message-input', function(event) {
        if(event.which == 13) {
            pushChat();
            setTimeout(function() {
                $(".message-input").val('');
            }, 10);
        }
    });
});
</script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('common/html_head') ?>

    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct"); ?>/fonts/md-fonts/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct"); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct"); ?>/libs/animate.css/animate.min.css">

     <!-- jquery-loading -->
     <link rel="stylesheet" href="<?php echo base_url("/theme/oct"); ?>/libs/jquery-loading/dist/jquery.loading.min.css">

    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="<?php echo base_url("/theme/oct"); ?>/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed">
    <?= $this->include('common/header') ?>
    <!-- end header -->

    <div class="app-body">
        <div class="sidebar" id="sidebar">
            <?= $this->include('common/left_bar') ?>
        </div>
        <!-- end sidebar -->

        <main class="main">
            <!-- Breadcrumb -->
            <?= $this->include('common/breadcrumb') ?>
            

            <div class="container-fluid">

                <div class="animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-pm-summary bg-theme">
                                <div class="card-body">

                                    <div class="clearfix">
                                        <div class="float-left">
                                            <div class="h3 text-white">
                                                <strong>Projects</strong>
                                            </div>
                                            <small class="text-white">4031 TOTAL</small>
                                        </div>

                                        <div class="float-right">
                                            <button class="btn btn-dark">New Project</button>
                                        </div>
                                    </div>
                                    <!-- end clearfix -->

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <div class="widget-pm-summary">
                                                    <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                                                    <div class="widget-text">
                                                        <div class="h2 text-white">241</div>
                                                        <small class="text-white">Published Project</small>
                                                    </div>
                                                    <!-- end widget-text -->
                                                </div>
                                                <!-- end widget-pm-simmary -->
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end inside-col -->

                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <div class="widget-pm-summary">
                                                    <i class="mdi mdi-google-circles"></i>
                                                    <div class="widget-text">
                                                        <div class="h2 text-white">3790</div>
                                                        <small class="text-white">Completed Tasks</small>
                                                    </div>
                                                    <!-- end widget-text -->
                                                </div>
                                                <!-- end widget-pm-simmary -->
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end inside-col -->

                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <div class="widget-pm-summary">
                                                    <i class="mdi mdi-chart-pie"></i>
                                                    <div class="widget-text">
                                                        <div class="h2 text-white">98%</div>
                                                        <small class="text-white">Successfull Tasks</small>
                                                    </div>
                                                    <!-- end widget-text -->
                                                </div>
                                                <!-- end widget-pm-simmary -->
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end inside-col -->

                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <div class="widget-pm-summary">
                                                    <i class="mdi mdi-file-tree"></i>
                                                    <div class="widget-text">
                                                        <div class="h2 text-white">158</div>
                                                        <small class="text-white">Ongoing Projects</small>
                                                    </div>
                                                    <!-- end widget-text -->
                                                </div>
                                                <!-- end widget-pm-simmary -->
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end inside-col -->
                                    </div>
                                    <!-- end inside row -->

                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-accent-danger">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-right">
                                                    <div class="h2 text-danger">50</div>
                                                </div>
                                            </div>
                                            <div class="float-left">
                                                <div class="h3 ">
                                                    <strong>Completed</strong>
                                                </div>
                                                <div class="h6 text-danger"> Project </div>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end inside col -->
                                <div class="col-md-6">
                                    <div class="card card-accent-success">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-right">
                                                    <div class="h2 text-success">10</div>
                                                </div>
                                            </div>
                                            <div class="float-left">
                                                <div class="h3 ">
                                                    <strong>Running</strong>
                                                </div>
                                                <div class="h6 text-success"> Client </div>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end inside col -->
                            </div>
                            <!-- end inside row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-accent-primary">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-right">
                                                    <div class="h2 text-primary">700</div>
                                                </div>
                                            </div>
                                            <div class="float-left">
                                                <div class="h3 ">
                                                    <strong>Hours</strong>
                                                </div>
                                                <div class="h6 text-primary"> Work </div>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end inside col -->
                                <div class="col-md-6">
                                    <div class="card card-accent-warning">
                                        <div class="card-body ">
                                            <div class="clearfix">
                                                <div class="float-right">
                                                    <div class="h2 text-warning">160</div>
                                                </div>
                                            </div>
                                            <div class="float-left">
                                                <div class="h3 ">
                                                    <strong>Hours</strong>
                                                </div>
                                                <div class="h6 text-warning"> Coffe </div>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end inside col -->

                            </div>
                            <!-- end inside row -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <div class="h5 ">
                                        <strong>Earning Statmant</strong>
                                    </div>
                                    <small class="text-theme">BASED ON LAST 30 DAYS</small>
                                    <canvas class="chart-canvas" id="earning-chart-success"></canvas>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-accent-info projects-charts-widget">
                                <div class="card-body">
                                    <div class="text-info h3">ILOSC
                                        <br/>Project</div>
                                    <div class="text-dark h2">
                                        <span class="text-secondary">$</span> 180,150</div>
                                    <div class="text-info ">
                                        <i class="fa fa-arrow-right"></i> 0%</div>
                                    <canvas class="chart-canvas" id="project-chart-info"></canvas>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-3">
                            <div class="card card-accent-danger projects-charts-widget">
                                <div class="card-body">
                                    <div class="text-danger h3">SOMS
                                        <br/>Project</div>
                                    <div class="text-dark h2">
                                        <span class="text-secondary">$</span> 10,000</div>
                                    <div class="text-danger ">
                                        <i class="fa fa-arrow-down"></i> 25.5%</div>
                                    <canvas class="chart-canvas" id="project-chart-danger"></canvas>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-3">
                            <div class="card card-accent-success projects-charts-widget">
                                <div class="card-body">
                                    <div class="text-success h3">STDM
                                        <br/>Project</div>
                                    <div class="text-dark h2">
                                        <span class="text-secondary">$</span> 523,658</div>
                                    <div class="text-success ">
                                        <i class="fa fa-arrow-up"></i> 80%</div>
                                    <canvas class="chart-canvas" id="project-chart-success"></canvas>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-3">
                            <div class="card card-accent-primary projects-charts-widget">
                                <div class="card-body">
                                    <div class="text-primary h3">ASLP
                                        <br/>Project</div>
                                    <div class="text-dark h2">
                                        <span class="text-secondary">$</span> 523,658</div>
                                    <div class="text-primary ">
                                        <i class="fa fa-arrow-left"></i> 0.8%</div>
                                    <canvas class="chart-canvas" id="project-chart-primary"></canvas>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">

                        <div class="col-md-6">
                            <div class="card  card-accent-theme">
                                <div class="message-widget">
                                    <h1> Messages
                                        <i class="fa fa-comments-o float-right"></i>
                                    </h1>

                                    <ul id="messageList">
                                        <li class="clearfix">
                                            <a href="#" class="dropdown-item">
                                                <div class="message-box ">
                                                    <div class="u-img float-left">
                                                        <img src="http://via.placeholder.com/100x100" alt="user" />
                                                        <span class="notification online"></span>
                                                    </div>
                                                    <div class="u-text float-left">
                                                        <div class="u-name">
                                                            <strong>Natalie Wall</strong>
                                                        </div>
                                                        <p class="text-muted">Anyways i would like just do it</p>

                                                    </div>
                                                </div>
                                                <small class="float-right">2 minuts ago</small>
                                            </a>
                                        </li>



                                        <li class="clearfix">
                                            <a href="#" class="dropdown-item">
                                                <div class="message-box ">
                                                    <div class="u-img float-left">
                                                        <img src="http://via.placeholder.com/100x100" alt="user" />
                                                        <span class="notification offline"></span>
                                                    </div>
                                                    <div class="u-text float-left">
                                                        <div class="u-name">
                                                            <strong>Steve johns</strong>
                                                        </div>
                                                        <p class="text-muted">There is Problem inside the Application</p>

                                                    </div>
                                                </div>
                                                <small class="float-right">10 minuts ago</small>
                                            </a>
                                        </li>

                                        <li class="clearfix">
                                            <a href="#" class="dropdown-item">
                                                <div class="message-box ">
                                                    <div class="u-img float-left">
                                                        <img src="http://via.placeholder.com/100x100" alt="user" />
                                                        <span class="notification away"></span>
                                                    </div>
                                                    <div class="u-text float-left">
                                                        <div class="u-name">
                                                            <strong>Tim Johns</strong>
                                                        </div>
                                                        <p class="text-muted">Anyways i would like just do it</p>

                                                    </div>
                                                </div>
                                                <small class="float-right">10 minuts ago</small>
                                            </a>
                                        </li>
                                        <li class="clearfix">
                                            <a href="#" class="dropdown-item">
                                                <div class="message-box ">
                                                    <div class="u-img float-left">
                                                        <img src="http://via.placeholder.com/100x100" alt="user" />
                                                        <span class="notification offline"></span>
                                                    </div>
                                                    <div class="u-text float-left">
                                                        <div class="u-name">
                                                            <strong>Steve johns</strong>
                                                        </div>
                                                        <p class="text-muted">There is Problem inside the Application</p>

                                                    </div>
                                                </div>
                                                <small class="float-right">10 minuts ago</small>
                                            </a>
                                        </li>
                                        <li class="clearfix">
                                            <a href="#" class="dropdown-item">
                                                <div class="message-box ">
                                                    <div class="u-img float-left">
                                                        <img src="http://via.placeholder.com/100x100" alt="user" />
                                                        <span class="notification buzy"></span>
                                                    </div>
                                                    <div class="u-text float-left">
                                                        <div class="u-name">
                                                            <strong>Taniya Jan</strong>
                                                        </div>
                                                        <p class="text-muted">Please Checkout The Attachment</p>

                                                    </div>
                                                </div>
                                                <small class="float-right">2 Days ago</small>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                                <!-- end card-body -->
                                <div class="card-footer text-center">
                                    <a href="" class="text-theme">
                                        <strong>See all messages (150) </strong>
                                    </a>

                                </div>
                                <!-- end card-footer -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-accent-left-danger widget-reminder">
                                        <div class="card-body">
                                            <ul>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                            </ul>

                                            <div class="reminder-text">
                                                <div class="time h3 text-danger">08:50</div>
                                                <div class="time h5 text-dark"><strong>MEETING</strong></div>
                                                <small>Discussion about PSML Project</small>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- div.card -->
                                </div>
                                <!-- end inside col -->

                                <div class="col-md-6">
                                    <div class="card card-accent-left-success widget-reminder">
                                        <div class="card-body">
                                            <ul>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                            </ul>

                                            <div class="reminder-text">
                                                <div class="time h3 text-success">08:50</div>
                                                <div class="time h5 text-dark"><strong>MEETING</strong></div>
                                                <small>Discussion about PSML Project</small>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- div.card -->
                                </div>
                                <!-- end inside col -->

                            </div>
                            <!-- end inside row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-accent-left-info widget-reminder">
                                        <div class="card-body">
                                            <ul>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                            </ul>

                                            <div class="reminder-text">
                                                <div class="time h3 text-info">08:50</div>
                                                <div class="time h5 text-dark"><strong>MEETING</strong></div>
                                                <small>Discussion about PSML Project</small>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- div.card -->
                                </div>
                                <!-- end inside col -->

                                <div class="col-md-6">
                                    <div class="card card-accent-left-warning widget-reminder">
                                        <div class="card-body">
                                            <ul>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                                <li><img src="http://via.placeholder.com/100x100" alt=""></li>
                                            </ul>

                                            <div class="reminder-text">
                                                <div class="time h3 text-warning">08:50</div>
                                                <div class="time h5 text-dark"><strong>MEETING</strong></div>
                                                <small>Discussion about PSML Project</small>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- div.card -->
                                </div>
                                <!-- end inside col -->

                            </div>
                            <!-- end inside row -->

                        </div>
                        <!-- end col -->

                    </div>
                    <!-- end row -->

                </div>
                <!-- end animated fadeIn -->
            </div>
            <!-- end container-fluid -->

        </main>
        <!-- end main -->


        <aside class="aside-menu">
            <div class="aside-header bg-theme text-uppercase">Service Panel</div>
            <div class="aside-body">
                <h6 class="text-theme">Light Sidebar</h6>
                <ul class="theme-colors">
                    <li class="theme-blue" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-blue.css')"></li>
                    <li class="theme-green" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-green.css')"></li>
                    <li class="theme-red" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-red.css')"></li>
                    <li class="theme-yellow" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-yellow.css')"></li>
                    <li class="theme-orange" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-orange.css')"></li>
                    <li class="theme-teal" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-teal.css')"></li>
                    <li class="theme-cyan" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-cyan.css')"></li>
                    <li class="theme-purple" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-purple.css')"></li>
                    <li class="theme-indigo" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-indigo.css')"></li>
                    <li class="theme-pink" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-pink.css')"></li>
                </ul>

                <!-- <h6 class="text-theme">Social Colors</h6> -->
                <ul class="theme-colors">
                    <li class="theme-facebook" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-facebook.css')"></li>
                    <li class="theme-twitter" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-twitter.css')"></li>
                    <li class="theme-linkedin" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-linkedin.css')"></li>
                    <li class="theme-google-plus" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-google-plus.css')"></li>
                    <li class="theme-flickr" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-flickr.css')"></li>
                    <li class="theme-tumblr" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-tumblr.css')"></li>
                    <li class="theme-xing" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-xing.css')"></li>
                    <li class="theme-github" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-github.css')"></li>
                    <li class="theme-html5" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-html5.css')"></li>
                    <li class="theme-openid" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-openid.css')"></li>
                    <li class="theme-stack-overflow" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-stack-overflow.css')"></li>
                    <li class="theme-css3" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-css3.css')"></li>
                    <li class="theme-dribbble" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-dribbble.css')"></li>
                    <li class="theme-instagram" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-instagram.css')"></li>
                    <li class="theme-pinterest" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-pinterest.css')"></li>
                    <li class="theme-vk" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-vk.css')"></li>
                    <li class="theme-yahoo" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-yahoo.css')"></li>
                    <li class="theme-behance" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-behance.css')"></li>
                    <li class="theme-dropbox" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-dropbox.css')"></li>
                    <li class="theme-reddit" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-reddit.css')"></li>
                    <li class="theme-spotify" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-spotify.css')"></li>
                    <li class="theme-vine" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-vine.css')"></li>
                    <li class="theme-foursquare" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-foursquare.css')"></li>
                    <li class="theme-vimeo" onclick="swapStyleSheet('<?php echo base_url("/theme/oct"); ?>/css/style-vimeo.css')"></li>

                </ul>

                <h6 class="text-theme">Dark Sidebar</h6>
                <ul class="theme-colors">
                    <li class="theme-blue" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-blue.css')"></li>
                    <li class="theme-green" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-green.css')"></li>
                    <li class="theme-red" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-red.css')"></li>
                    <li class="theme-yellow" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-yellow.css')"></li>
                    <li class="theme-orange" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-orange.css')"></li>
                    <li class="theme-teal" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-teal.css')"></li>
                    <li class="theme-cyan" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-cyan.css')"></li>
                    <li class="theme-purple" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-purple.css')"></li>
                    <li class="theme-indigo" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-indigo.css')"></li>
                    <li class="theme-pink" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-pink.css')"></li>
                </ul>

                <!-- <h6 class="text-theme">Social Colors</h6> -->
                <ul class="theme-colors">
                    <li class="theme-facebook" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-facebook.css')"></li>
                    <li class="theme-twitter" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-twitter.css')"></li>
                    <li class="theme-linkedin" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-linkedin.css')"></li>
                    <li class="theme-google-plus" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-google-plus.css')"></li>
                    <li class="theme-flickr" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-flickr.css')"></li>
                    <li class="theme-tumblr" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-tumblr.css')"></li>
                    <li class="theme-xing" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-xing.css')"></li>
                    <li class="theme-github" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-github.css')"></li>
                    <li class="theme-html5" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-html5.css')"></li>
                    <li class="theme-openid" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-openid.css')"></li>
                    <li class="theme-stack-overflow" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-stack-overflow.css')"></li>
                    <li class="theme-css3" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-css3.css')"></li>
                    <li class="theme-dribbble" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-dribbble.css')"></li>
                    <li class="theme-instagram" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-instagram.css')"></li>
                    <li class="theme-pinterest" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-pinterest.css')"></li>
                    <li class="theme-vk" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-vk.css')"></li>
                    <li class="theme-yahoo" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-yahoo.css')"></li>
                    <li class="theme-behance" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-behance.css')"></li>
                    <li class="theme-dropbox" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-dropbox.css')"></li>
                    <li class="theme-reddit" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-reddit.css')"></li>
                    <li class="theme-spotify" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-spotify.css')"></li>
                    <li class="theme-vine" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-vine.css')"></li>
                    <li class="theme-foursquare" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-foursquare.css')"></li>
                    <li class="theme-vimeo" onclick="swapStyleSheetDark('<?php echo base_url("/theme/oct"); ?>/css/style-vimeo.css')"></li>

                </ul>
            </div>

        </aside>
        <!-- end aside -->

    </div>
    <!-- end app-body -->
    
    <?= $this->include('common/footer') ?>

    <?= $this->include('common/html_footer') ?>

    <!-- dashboard-pm -example -->
    <script src="<?php echo base_url("/theme/oct"); ?>/js/dashboard-pm-example.js"></script>

</body>

</html>
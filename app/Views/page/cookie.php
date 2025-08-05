<!DOCTYPE html>
<html lang="en">

<head>

    <?= $this->include('common/html_head') ?>

    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/fonts/md-fonts/css/materialdesignicons.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/fonts/font-awesome-4.7.0/css/font-awesome.min.css"); ?>">
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/libs/animate.css/animate.min.css"); ?>">
     <!-- jquery-loading -->
     <link rel="stylesheet" href="<?php echo base_url("/theme/oct/libs/jquery-loading/dist/jquery.loading.min.css"); ?>">

    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="<?php echo base_url("/theme/oct/css/style.css"); ?>">

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

            <div class="container">

                <div class="animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <h3>Canopus Pvt Ltd Cookie Policy</h3>
                                    <small>
                                        Updated 16 May 2021 
                                    </small>

                                    <p>Please read this cookie policy carefully as it contains important information on who we are 
                                        and how we use cookies on our website. This policy should be read together with our privacy 
                                        policy which sets out how and why we collect, store, use and share personal information 
                                        generally, as well as your rights in relation to your personal information and details of 
                                        how to contact us and supervisory authorities if you have a complaint. </p>
                                    
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
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

        <?= $this->include('common/aside') ?>
        <!-- end aside -->

    </div>
    <!-- end app-body -->



    <?= $this->include('common/footer') ?>

    <?= $this->include('common/html_footer') ?>

</body>

</html>
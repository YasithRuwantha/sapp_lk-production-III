<!doctype html>
<html lang="en">

<head>
<?= $this->include('common/html_head') ?>
<!-- VENDOR CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/theme/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/theme/assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/theme/assets/vendor/animate-css/vivify.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/theme/html/assets/css/site.min.css">
</head>
<body class="theme-cyan font-montserrat">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<!-- Theme Setting -->
<div class="themesetting">
    <a href="javascript:void(0);" class="theme_btn"><i class="icon-magic-wand"></i></a>
    <div class="card theme_color">
        <div class="header">
            <h2>Theme Color</h2>
        </div>
        <ul class="choose-skin list-unstyled mb-0">
            <li data-theme="green"><div class="green"></div></li>
            <li data-theme="orange"><div class="orange"></div></li>
            <li data-theme="blush"><div class="blush"></div></li>
            <li data-theme="cyan" class="active"><div class="cyan"></div></li>
            <li data-theme="indigo"><div class="indigo"></div></li>
            <li data-theme="red"><div class="red"></div></li>
        </ul>
    </div>
    <div class="card font_setting">
        <div class="header">
            <h2>Font Settings</h2>
        </div>
        <div>
            <div class="fancy-radio mb-2">
                <label><input name="font" value="font-krub" type="radio"><span><i></i>Krub Google font</span></label>
            </div>
            <div class="fancy-radio mb-2">
                <label><input name="font" value="font-montserrat" type="radio" checked><span><i></i>Montserrat Google font</span></label>
            </div>
            <div class="fancy-radio">
                <label><input name="font" value="font-roboto" type="radio"><span><i></i>Robot Google font</span></label>
            </div>
        </div>
    </div>
    <div class="card setting_switch">
        <div class="header">
            <h2>Settings</h2>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                Light Version
                <div class="float-right">
                    <label class="switch">
                        <input type="checkbox" class="lv-btn">
                        <span class="slider round"></span>
                    </label>
                </div>
            </li>
            <li class="list-group-item">
                RTL Version
                <div class="float-right">
                    <label class="switch">
                        <input type="checkbox" class="rtl-btn">
                        <span class="slider round"></span>
                    </label>
                </div>
            </li>
            <li class="list-group-item">
                Horizontal Henu
                <div class="float-right">
                    <label class="switch">
                        <input type="checkbox" class="hmenu-btn" >
                        <span class="slider round"></span>
                    </label>
                </div>
            </li>
            <li class="list-group-item">
                Mini Sidebar
                <div class="float-right">
                    <label class="switch">
                        <input type="checkbox" class="mini-sidebar-btn">
                        <span class="slider round"></span>
                    </label>
                </div>
            </li>
        </ul>
    </div>   
    <div class="card">
        <div class="form-group">
            <label class="d-block">Traffic this Month <span class="float-right">77%</span></label>
            <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="d-block">Server Load <span class="float-right">50%</span></label>
            <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">
    <?= $this->include('common/top_nav') ?>    
    

    <?= $this->include('common/search'); ?> 
    <?= $this->include('common/mega_menue'); ?> 
    <?= $this->include('common/right_nav'); ?>  
    <?= $this->include('common/left_nav'); ?>  


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Project List</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Oculux</a></li>
                            <li class="breadcrumb-item"><a href="#">Project</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                            </ol>
                        </nav>
                    </div>            
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create Campaign</a>
                        <a href="https://themeforest.net/item/oculux-bootstrap-4x-admin-dashboard-clean-modern-ui-kit/23091507" class="btn btn-sm btn-success" title="Themeforest"><i class="icon-basket"></i> Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Milestone">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Status">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Priority">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-block" title="">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                                <tr>
                                    <th>Owner</th>
                                    <th>Milestone</th>                                    
                                    <th>Status</th>
                                    <th class="w100">Work</th>
                                    <th class="w100">Duration</th>
                                    <th>Priority</th>
                                    <th class="w200">Task</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar1.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Isidore Dilao</span></td>
                                    <td><h6 class="mb-0">Account receivable</h6></td>
                                    <td><span class="badge badge-danger">Issue Found</span></td>
                                    <td><span>30:00</span></td>
                                    <td>30:0 hrs</td>
                                    <td><span class="text-warning">Medium</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="74" aria-valuenow="74" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar2.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Maricel Villalon</span></td>
                                    <td><h6 class="mb-0">Account receivable</h6></td>
                                    <td><span class="badge badge-primary">Open</span></td>
                                    <td><span>68:00</span></td>
                                    <td>105:0 hrs</td>
                                    <td><span class="text-danger">High</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="23" aria-valuenow="23" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar3.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Theresa Wright</span></td>
                                    <td><h6 class="mb-0">Approval site</h6></td>
                                    <td><span class="badge badge-primary">Open</span></td>
                                    <td><span>74:00</span></td>
                                    <td>89:0 hrs</td>
                                    <td><span>None</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="55" aria-valuenow="55" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar4.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Jason Porter</span></td>
                                    <td><h6 class="mb-0">Final touch up</h6></td>
                                    <td><span class="badge badge-info">Issue Level 1</span></td>
                                    <td><span>30:00</span></td>
                                    <td>30:0 hrs</td>
                                    <td><span>None</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="23" aria-valuenow="23" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar5.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Annelyn Mercado</span></td>
                                    <td><h6 class="mb-0">Account receivable</h6></td>
                                    <td><span class="badge badge-danger">Issue Found</span></td>
                                    <td><span>30:00</span></td>
                                    <td>30:0 hrs</td>
                                    <td><span>None</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="31" aria-valuenow="31" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar6.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Sean Black</span></td>
                                    <td><h6 class="mb-0">Basement slab preparation</h6></td>
                                    <td><span class="badge badge-primary">Open</span></td>
                                    <td><span>88:00</span></td>
                                    <td>88:0 hrs</td>
                                    <td><span>None</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="89" aria-valuenow="89" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar7.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Scott Ortega</span></td>
                                    <td><h6 class="mb-0">Account receivable</h6></td>
                                    <td><span class="badge badge-warning">Issue Level 2</span></td>
                                    <td><span>56:00</span></td>
                                    <td>125:0 hrs</td>
                                    <td><span class="text-warning">Medium</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="23" aria-valuenow="23" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../assets/images/xs/avatar8.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>David Wallace</span></td>
                                    <td><h6 class="mb-0">Account receivable</h6></td>
                                    <td><span class="badge badge-danger">Issue Found</span></td>
                                    <td><span>30:00</span></td>
                                    <td>30:0 hrs</td>
                                    <td><span>None</span></td>
                                    <td>
                                        <div class="progress progress-xxs progress-transparent custom-color-green mb-0 mt-0">
                                            <div class="progress-bar" data-transitiongoal="23" aria-valuenow="23" style="width: 0%;"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Javascript -->
<script src="<?php echo base_url(); ?>/theme/html/assets/bundles/libscripts.bundle.js"></script>    
<script src="<?php echo base_url(); ?>/theme/html/assets/bundles/vendorscripts.bundle.js"></script>
<script src="<?php echo base_url(); ?>/theme/html/assets/bundles/mainscripts.bundle.js"></script>
<?= $this->include('common/html_footer') ?>
</body>
</html>

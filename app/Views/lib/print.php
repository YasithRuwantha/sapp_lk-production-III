
<!-- DEBUG-VIEW START 4 APPPATH/Views/user/list_all.php -->

<!DOCTYPE html>
<html lang="en">
	<head>
<script type="text/javascript"  id="debugbar_loader" data-time="1647453662" src="https://sapp.canopuz.com/index.php?debugbar"></script><script type="text/javascript"  id="debugbar_dynamic_script"></script><style type="text/css"  id="debugbar_dynamic_style"></style>

        <!-- DEBUG-VIEW START 1 APPPATH/Views/common/html_head.php -->
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>SAPP</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://sapp.canopuz.com/public/theme/html-files/template/assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="https://sapp.canopuz.com/public/theme/html-files/template/assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="https://sapp.canopuz.com/public/theme/html-files/template/assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="https://sapp.canopuz.com/public/theme/html-files/template/assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/js/html5shiv.min.js"></script>
			<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/js/respond.min.js"></script>
		<![endif]-->
<!-- DEBUG-VIEW ENDED 1 APPPATH/Views/common/html_head.php -->
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="https://sapp.canopuz.com/public/theme/html-files/template/assets/plugins/datatables/datatables.min.css">
		
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<!-- DEBUG-VIEW START 2 APPPATH/Views/common/header.php -->
            <div class="header">
			
				<!-- Logo -->
				<div class="header-left">
					<a href="https://sapp.canopuz.com" class="logo">
						<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/logo.png" alt="Logo">
					</a>
					<a href="https://sapp.canopuz.com" class="logo logo-small">
						<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/logo-small.png" alt="Logo" width="30" height="30">
					</a>
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

					<!-- Flag 
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
							<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/flags/us.png" alt="" height="20"> <span>English</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/flags/us.png" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/flags/fr.png" alt="" height="16"> French
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/flags/es.png" alt="" height="16"> Spanish
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/flags/de.png" alt="" height="16"> German
							</a>
						</div>
					</li>
					
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
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="" src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/profiles/avatar-02.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Brian Johnson</span> paid the invoice <span class="noti-title">#DF65485</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="" src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/profiles/avatar-03.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Marie Canales</span> has accepted your estimate <span class="noti-title">#GTR458789</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<div class="avatar avatar-sm">
													<span class="avatar-title rounded-circle bg-primary-light"><i class="far fa-user"></i></span>
												</div>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">New user registered</span></p>
													<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="" src="https://sapp.canopuz.com/public/theme/html-files/template/assets/img/profiles/avatar-04.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Barbara Moore</span> declined the invoice <span class="noti-title">#RDW026896</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<div class="avatar avatar-sm">
													<span class="avatar-title rounded-circle bg-info-light"><i class="far fa-comment"></i></span>
												</div>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">You have received a new message</span></p>
													<p class="noti-time"><span class="notification-time">2 days ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					 /Notifications -->
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img">
								<img src="https://sapp.canopuz.com/public/resource/user/d80d4fcd8d9879cef2f364e345b2c1c1.jpg" alt="">
								<span class="status online"></span>
							</span>
							<span>Sugunan</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="https://sapp.canopuz.com/user/profile"><i data-feather="user" class="me-1"></i> Profile</a>
							<a class="dropdown-item" href="https://sapp.canopuz.com/user/logout"><i data-feather="log-out" class="me-1"></i> Logout</a>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Menu -->
				
			</div>
<!-- DEBUG-VIEW ENDED 2 APPPATH/Views/common/header.php -->
			<!-- /Header -->
			
			<!-- Sidebar -->
			<!-- DEBUG-VIEW START 3 APPPATH/Views/common/left_bar.php -->
            			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"><span>Main</span></li>
														<li class="submenu">
								<a href="#"><i class="fa fa-home"></i><span> Home</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/default">Overview</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> Users</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/users">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/user/add_edit">Add Users</a></li>
									<li><a class="active" href="https://sapp.canopuz.com/user/list_all">List Users</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-tractor"></i><span> Farmer</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/farmer_summary">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">DSD - Distribution</a></li>
									<li><a class="" href="https://sapp.canopuz.com/user/farmer_district?user_type=2">District</a></li>	
									<li><a class="" href="https://sapp.canopuz.com/user/farmer_project?user_type=2">Project</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-users"></i><span> SAPP Staff</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">List Staff</a></li>								
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-truck"></i><span> EOI</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Add EOI</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">List EOI</a></li>								
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i><span> Projects</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/project_location">Locations</a></li>
									<li><a class="" href="https://sapp.canopuz.com/project/add_edit">Add Project</a></li>
									<li><a class="" href="https://sapp.canopuz.com/project/list_all">List Projects</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-bullhorn"></i><span> Promoters</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/promoter_summary">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/promoter/add_edit">Add Promoter</a></li>
									<li><a class="" href="https://sapp.canopuz.com/promoter/list_all">List Promoters</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-money-bill"></i><span> Assistance</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Loan</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Grant</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-random"></i><span> Off Farm Development</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Off Farm</a></li>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/underconstruction">Off Farm</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-book-open"></i><span> Training</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/dashboard/training_summary">Summary</a></li>
									<li><a class="" href="https://sapp.canopuz.com/training/add_edit">Schedule Training</a></li>
									<li><a class="" href="https://sapp.canopuz.com/training/list_all">List Training</a></li>									
								</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-signal"></i><span> Progress Reporting</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://sapp.canopuz.com/progress/list_all">Monthly</a></li>								
								</ul>
							</li>
													</ul>
					</div>
				</div>
			</div>
<!-- DEBUG-VIEW ENDED 3 APPPATH/Views/common/left_bar.php -->
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Users</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/dashboard/default/">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">Users</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="https://sapp.canopuz.com/user/add_edit" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								</a>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					<!-- Search Filter -->
                    <form method="get" action="https://sapp.canopuz.com/user/list_all">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>First Name</label>
										<input name="fname" value="" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Last Name</label>
										<input name="lname" value="" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Email</label>
										<input name="email" value="" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Phone</label>
										<input name="mobile" value="" type="text" class="form-control">
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Personal Identification No</label>
										<input name="pin" value="" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
								<div class="form-group">
										<label>User Type</label>
										<select class="form-select" name="user_type">
											<option value="">-- Select --</option>
																							<option  value="1">Staff</option>
																							<option  value="2">Farmer</option>
																							<option  value="3">Producer</option>
																							<option  value="4">Promoter</option>
																					</select>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>
                    </form>
					<!-- /Search Filter -->
					
					<div class="row">
						<div class="col-sm-12">
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Customer</th>
                                                    <th>Personal Identification No</th>
													<th>Email</th>
													<th>Phone</th>   
													<th>User Type</th>                                                  
													<th>Registered On</th>
													<th>Status</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/user/d80d4fcd8d9879cef2f364e345b2c1c1.jpg" alt="User Image"></a>
															<a href="profile.html">Sugunan Kumaraguru</a>
														</h2>
													</td>
                                                    <td>851122230V</td>
													<td>zugunan@gmail.com</td>
													<td>0775143832</td>
													<td>Staff</td>
													<td>2022-01-22 07:12:19</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/1" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/1" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/user/6f3aad000df2e8e1d25853763679fdd9.png" alt="User Image"></a>
															<a href="profile.html">Thulasi Varman</a>
														</h2>
													</td>
                                                    <td>861423214V</td>
													<td>thulasivarman@gmail.com</td>
													<td>0772281802</td>
													<td>Farmer</td>
													<td>2022-01-23 02:43:54</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/2" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/2" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/common/placeholder.png" alt="User Image"></a>
															<a href="profile.html">Staff Staff</a>
														</h2>
													</td>
                                                    <td>456984555V</td>
													<td>staff@gmail.com</td>
													<td>0444124578</td>
													<td>Staff</td>
													<td>2022-01-30 10:42:22</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/4" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/4" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/common/placeholder.png" alt="User Image"></a>
															<a href="profile.html">Farmer Farmer</a>
														</h2>
													</td>
                                                    <td>4587915910V</td>
													<td>farmer@gmail.com</td>
													<td>0111456987</td>
													<td>Farmer</td>
													<td>2022-01-30 10:48:46</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/5" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/5" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/common/placeholder.png" alt="User Image"></a>
															<a href="profile.html">Producer Producer</a>
														</h2>
													</td>
                                                    <td>5674125832V</td>
													<td>producer@gmail.com</td>
													<td>0112456369</td>
													<td>Farmer</td>
													<td>2022-01-30 10:49:52</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/6" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/6" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/common/placeholder.png" alt="User Image"></a>
															<a href="profile.html">Promoter Promoter</a>
														</h2>
													</td>
                                                    <td>8945612312V</td>
													<td>promoter@gmail.com</td>
													<td>0555689542</td>
													<td>Promoter</td>
													<td>2022-01-30 10:50:39</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/7" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/7" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/common/placeholder.png" alt="User Image"></a>
															<a href="profile.html">Ragulan Balasingam</a>
														</h2>
													</td>
                                                    <td>871843551X</td>
													<td>ragulan@sapp.lk</td>
													<td>0768428058</td>
													<td>Staff</td>
													<td>2022-02-07 08:15:46</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/9" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/9" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
                                            												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="https://sapp.canopuz.com/public/resource/common/placeholder.png" alt="User Image"></a>
															<a href="profile.html">user adsd</a>
														</h2>
													</td>
                                                    <td>3123v</td>
													<td>sdfsdf@gmail.com</td>
													<td>323434</td>
													<td>Farmer</td>
													<td>2022-03-16 01:30:23</td>
													<td><span class="badge badge-pill bg-primary-light">Active</span></td>
													<td class="text-right">
														<a href="https://sapp.canopuz.com/user/add_edit/11" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="https://sapp.canopuz.com/user/delete/11" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
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
			</div>
			<!-- /Page Wrapper -->
			
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/js/feather.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Datatables JS -->
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="https://sapp.canopuz.com/public/theme/html-files/template/assets/js/script.js"></script>
        
	</body>
</html>
<!-- DEBUG-VIEW ENDED 4 APPPATH/Views/user/list_all.php -->

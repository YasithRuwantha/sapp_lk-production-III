
<!-- DEBUG-VIEW START 4 APPPATH/Views/user/farmer.php -->
<!DOCTYPE html>
<html lang="en">
	<head>
<script type="text/javascript"  id="debugbar_loader" data-time="1657654887" src="https://mis-sapp.com/index.php?debugbar"></script><script type="text/javascript"  id="debugbar_dynamic_script"></script><style type="text/css"  id="debugbar_dynamic_style"></style>

        <!-- DEBUG-VIEW START 1 APPPATH/Views/common/html_head.php -->
       <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>SAPP</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="https://mis-sapp.com/public/theme/html-files/template/assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://mis-sapp.com/public/theme/html-files/template/assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="https://mis-sapp.com/public/theme/html-files/template/assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="https://mis-sapp.com/public/theme/html-files/template/assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="https://mis-sapp.com/public/theme/html-files/template/assets/css/style.css?202207121407=2344">
		
		<!--[if lt IE 9]>
			<script src="https://mis-sapp.com/public/theme/html-files/template/assets/js/html5shiv.min.js"></script>
			<script src="https://mis-sapp.com/public/theme/html-files/template/assets/js/respond.min.js"></script>
		<![endif]-->
<!-- DEBUG-VIEW ENDED 1 APPPATH/Views/common/html_head.php -->

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="https://mis-sapp.com/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="https://mis-sapp.com/public/theme/html-files/template/assets/css/bootstrap-datetimepicker.min.css">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
	</head>
	<body onload="initialize();">
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<!-- DEBUG-VIEW START 2 APPPATH/Views/common/header.php -->
            <div class="header">
			
				<!-- Logo -->
				<div class="header-left">
					<a href="https://mis-sapp.com" class="logo">
						<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/logo.png" alt="Logo">
					</a>
					<a href="https://mis-sapp.com" class="logo logo-small">
						<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/logo-small.png" alt="Logo" width="30" height="30">
					</a>
				</div>
				<!-- /Logo -->
				
				<!-- Sidebar Toggle -->
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fas fa-bars"></i>
				</a>
				<!-- /Sidebar Toggle -->
				
				<!-- Search 
				<div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fas fa-search"></i></button>
					</form>
				</div>
				 /Search -->
				
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
							<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/flags/us.png" alt="" height="20"> <span>English</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/flags/us.png" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/flags/fr.png" alt="" height="16"> French
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/flags/es.png" alt="" height="16"> Spanish
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="https://mis-sapp.com/public/theme/html-files/template/assets/img/flags/de.png" alt="" height="16"> German
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
													<img class="avatar-img rounded-circle" alt="" src="https://mis-sapp.com/public/theme/html-files/template/assets/img/profiles/avatar-02.jpg">
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
													<img class="avatar-img rounded-circle" alt="" src="https://mis-sapp.com/public/theme/html-files/template/assets/img/profiles/avatar-03.jpg">
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
													<img class="avatar-img rounded-circle" alt="" src="https://mis-sapp.com/public/theme/html-files/template/assets/img/profiles/avatar-04.jpg">
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
								<img src="https://mis-sapp.com/public/resource/user/d80d4fcd8d9879cef2f364e345b2c1c1.jpg" alt="">
								<span class="status online"></span>
							</span>
							<span>Sugunan</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="https://mis-sapp.com/user/profile"><i data-feather="user" class="me-1"></i> Profile</a>
							<a class="dropdown-item" href="https://mis-sapp.com/user/logout"><i data-feather="log-out" class="me-1"></i> Logout</a>
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
													<li class="menu-title"><span>SUMMARY</span></li>
														<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> Home</span> <span class="menu-arrow"></span></a>
																<ul>
									<li><a class="" href="https://mis-sapp.com/dashboard/default">Overview</a></li>
								</ul>
															</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-signal"></i><span> Reports</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://mis-sapp.com/reports/loan_profile">4P Registration</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/benificiary">Beneficiary Details</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/training_programmes">Training Programmes</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/loan_disbursement">Loan Disbursement</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/sapp_progress">SAPP Progress</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/promotor">Promotor</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/nsc_paper">NSC Paper</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/eoi">EOI</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/procurement">Procurement</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/off_farm_development">OFF Farm Development</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/report_youth_farmer">Youth Farmer</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/report_non_eligible_farmers">Non Eligible Farmers</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/list_of_4P_projects">List of 4P Projects</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/contracts">Contracts</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/inventory">Inventory</a></li>
									<li><a class="" href="https://mis-sapp.com/reports/is">IS</a></li>
								</ul>
							</li>
														<li class="menu-title"><span>SAPP</span></li>
														<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> User Mgt</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="" href="https://mis-sapp.com/user/add_edit">Add Users</a></li>
									<li><a class="" href="https://mis-sapp.com/user/list_all">List Users</a></li>
									<li><a class="" href="https://mis-sapp.com/user_group/add_edit">Add Users Group</a></li>
									<li><a class="" href="https://mis-sapp.com/user_group/list_all">List Users Group</a></li>										
								</ul>
							</li>
							
														<li class="submenu">
								<a href="#"><i class="fa fa-desktop"></i><span> HR & A</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/fixed_assert/add_edit">Add Inventory</a></li>
																												<li><a class="" href="https://mis-sapp.com/fixed_assert/list_all">List Inventory</a></li>
																												<li><a class="" href="https://mis-sapp.com/user/list_staff">List PMU Staff</a></li>
																			
										<li><a class="" href="https://mis-sapp.com/staff_leave/add_edit">Attendance </a></li>
																				
										<li><a class="" href="https://mis-sapp.com/staff_contract_mgt/add_edit">Add Staff Contract Mgt</a></li>
																			
										<li><a class="" href="https://mis-sapp.com/staff_contract_mgt/list_all">List Staff Contract Mgt</a></li>						
																	</ul>
							</li>
							
														<li class="submenu">
								<a href="#"><i class="fa fa-store"></i><span> Procurement</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/contract/add_edit">Add Contract</a></li>	
																												<li><a class="" href="https://mis-sapp.com/contract/list_all">List Contract</a></li>
																												<li><a class="" href="https://mis-sapp.com/contract_supplier/add_edit">Add Contract Supplier</a></li>	
																												<li><a class="" href="https://mis-sapp.com/contract_supplier/list_all">List Contract Supplier</a></li>
																												<li><a class="" href="https://mis-sapp.com/procurement/add_edit">Add Procurement</a></li>
																												<li><a class="" href="https://mis-sapp.com/procurement/list_all">List Procurement</a></li>						
																	</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-book-open"></i><span> M&E</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/nsc_meeting/add_edit">Add NSC</a></li>	
																												<li><a class="" href="https://mis-sapp.com/nsc_meeting/list_all">List NSC</a></li>
																												<li><a class="" target="_blank" href="https://mis-sapp.com/mis">Survey</a></li>					
																												<li><a class="" href="https://mis-sapp.com/training/add_edit">Add Training</a></li>
																												<li><a class="" href="https://mis-sapp.com/training/list_all">List Training</a></li>
																	</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-book-open"></i><span> Doc Archive</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/doc_archive/add_edit">Add Doc Archive</a></li>	
																												<li><a class="" href="https://mis-sapp.com/doc_archive/list_all">List Doc Archive</a></li>
																	</ul>
							</li>
														<li class="menu-title"><span>PROJECT MGT</span></li>

														<li class="submenu">
								<a href="#"><i class="fa fa-truck"></i><span> EOI</span> <span class="menu-arrow"></span></a>
								<ul>
																												<li><a class="" href="https://mis-sapp.com/eoi/list_all">List EOI</a></li>
																																					<li><a class="" href="https://mis-sapp.com/eoi_applicant/list_all">List EOI Applicant</a></li>
																	</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-bullhorn"></i><span> Promoter</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/promoter/add_edit">Add Promoter</a></li>
																												<li><a class="" href="https://mis-sapp.com/promoter/list_all">List Promoters</a></li>									
																	</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i><span> Projects</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/project/add_edit">Add Project</a></li>
																												<li><a class="" href="https://mis-sapp.com/project/list_all">List Projects</a></li>									
																																			</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i><span> IS</span> <span class="menu-arrow"></span></a>
								<ul>
																
										<li><a class="" href="https://mis-sapp.com/is/add_edit">Add IS</a></li>
																																												</ul>
							</li>
														<li class="menu-title"><span>BENEFICIARY MGT</span></li>
														<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> Beneficiary</span> <span class="menu-arrow"></span></a>
								<ul>	
																	<li><a class="" href="https://mis-sapp.com/user/add_edit?user_type=2">Add Beneficiary</a></li>
																									<li><a class="" href="https://mis-sapp.com/user/farmer_project?user_type=2">List Beneficiary</a></li>
																</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-coins"></i><span> Loan</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/loan/add_edit">Add Loan Group</a></li>
																												<li><a class="" href="https://mis-sapp.com/loan/list_all">List Loan Group</a></li>
																	</ul>
							</li>
																					<li class="submenu">
								<a href="#"><i class="fa fa-money-bill"></i><span> Grant</span> <span class="menu-arrow"></span></a>
								<ul>
																			<li><a class="" href="https://mis-sapp.com/grant/add_edit">Add Grant  Group</a></li>
																												<li><a class="" href="https://mis-sapp.com/grant/list_all">List Grant  Group</a></li>
																																			</ul>
							</li>
														<li class="menu-title"><span>PROMOTER PROGRESS</span></li>
																			</ul>
					</div>
				</div>
			</div>
<!-- DEBUG-VIEW ENDED 3 APPPATH/Views/common/left_bar.php -->
			
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
					<div class="page-header">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="page-title">Settings</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="https://mis-sapp.com/user/list_all">Users</a>
									</li>
									<li class="breadcrumb-item active">Farmer</li>
								</ul>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-xl-3 col-md-4">
						
							<!-- Settings Menu -->
							<div class="widget settings-menu">
								<ul>
									<li class="nav-item">
										<a href="https://mis-sapp.com/user/add_edit/138" class="nav-link">
											<i class="far fa-user"></i> <span>Basic Info</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="https://mis-sapp.com/user/farmer/138" class="nav-link active">
											<i class="far fa-address-card"></i> <span>Farmer Meta</span>
										</a>
									</li>
									<!--
									<li class="nav-item">
										<a href="https://mis-sapp.com/farmer/project_update/138" class="nav-link">
											<i class="far fa-file"></i> <span>Project</span>
										</a>
									</li>
-->
								</ul>
							</div>
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
						
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Farmer</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
                                    									<form method="post" action="https://mis-sapp.com/user/farmer/138" enctype="multipart/form-data">
                                       



										<div class="row form-group">
											<label for="field-label-59" class="col-sm-3 col-form-label input-label">Latitude</label>											
											<div class="col-sm-9">
                                                												<input type="number" step="0.00000000001" class="lat form-control" id="txtLat" name="lat" value="6.98000000000">
                                                											</div>
										</div>

										<div class="row form-group">
											<label for="field-label-60" class="col-sm-3 col-form-label input-label">Longitude</label>											
											<div class="col-sm-9">
                                                												<input type="number" step="0.00000000001" class="lng form-control" id="txtLng" name="lng" value="80.00000000000">
                                                											</div>
										</div>

										<div id="map_canvas" class="form-group row" style="height:800px;"></div>

										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>
									<!-- /Form -->
									
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
		<script src="https://mis-sapp.com/public/theme/html-files/template/assets/js/jquery-3.6.0.min.js"></script>
		

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKx3DR9sicrZ-ruthKe5GgtvfxphX8NL4&v=weekly"
        async
        ></script>

        <script type="text/javascript">
			function initialize() {
alert();
								// Creating map object
				var map = new google.maps.Map(document.getElementById('map_canvas'), {
					zoom: 8,
					center: new google.maps.LatLng(6.98000000000, 80.00000000000),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});

				// creates a draggable marker to the given coords
				var vMarker = new google.maps.Marker({
					position: new google.maps.LatLng(6.98000000000, 80.00000000000),
					draggable: true
				});
				
				// adds a listener to the marker
				// gets the coords when drag event ends
				// then updates the input with the new coords
				google.maps.event.addListener(vMarker, 'dragend', function (evt) {
					$("#txtLat").val(evt.latLng.lat().toFixed(6));
					$("#txtLng").val(evt.latLng.lng().toFixed(6));

					map.panTo(evt.latLng);
				});

				// centers the map on markers coords
				map.setCenter(vMarker.position);

				// adds the marker on the map
				vMarker.setMap(map);
			}
		</script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>


		
	</body>
</html>
<!-- DEBUG-VIEW ENDED 4 APPPATH/Views/user/farmer.php -->

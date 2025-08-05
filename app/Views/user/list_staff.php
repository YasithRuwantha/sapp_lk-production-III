
<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.css"); ?>">
		
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?= $this->include('common/header') ?>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<?= $this->include('common/left_bar') ?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">PMU Staff</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/dashboard/default/">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">PMU Staff</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="<?php echo base_url("/user/add_edit/"); ?>" class="btn btn-primary me-1">
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
                    <form method="get" action="<?php echo base_url("/user/list_staff/"); ?>">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>First Name</label>
										<input name="fname" value="<?php if(isset($_GET['fname'])){ echo $_GET['fname']; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Last Name</label>
										<input name="lname" value="<?php if(isset($_GET['lname'])){ echo $_GET['lname']; } ?>" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Email</label>
										<input name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email']; } ?>" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Phone</label>
										<input name="mobile" value="<?php if(isset($_GET['mobile'])){ echo $_GET['mobile']; } ?>" type="text" class="form-control">
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Personal Identification No</label>
										<input name="pin" value="<?php if(isset($_GET['pin'])){ echo $_GET['pin']; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
								<div class="form-group">
										<label>User Type</label>
										<select class="form-select" name="user_type">
											<option value="">-- Select --</option>
											<?php foreach($user_type as $key=>$val){ ?>
												<option <?php if(isset($_GET['user_type']) && $key == $_GET['user_type']){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
											<?php } ?>
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
													<th>Name</th>
                                                    <th>Designation</th>
													<th>Division</th>
													<th>Mobile</th>   
													<th>Email</th>                                                  
													<th>Phone Office</th>
													<th>Ext</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="<?php echo base_url("/user/add_edit/" . $val['id']); ?>" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="<?php echo base_url($val['relative_path']); ?>" alt="User Image"></a>
															<a href="<?php echo base_url("/user/add_edit/" . $val['id']); ?>"><?php echo $val['fname'] . " " . $val['lname']; ?></a>
														</h2>
													</td>
                                                    <td><?php echo $val['designation']; ?></td>													
                                                    <td><?php if(isset($assigned_admin_division[$val['assigned_admin_division']])){ echo $assigned_admin_division[$val['assigned_admin_division']]; } ?></td>
													<td><?php echo $val['mobile']; ?></td>
                                                    <td><?php echo $val['email']; ?></td>
													<td><?php echo $val['phone_office']; ?></td>
                                                    <td><?php echo $val['phone_extension']; ?></td>                                                    
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
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
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/jquery-3.6.0.min.js"); ?>"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/bootstrap.bundle.min.js"); ?>"></script>
		
		<!-- Feather Icon JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/feather.min.js"); ?>"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/slimscroll/jquery.slimscroll.min.js"); ?>"></script>
		
		<!-- Datatables JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.js"); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>
        
	</body>
</html>
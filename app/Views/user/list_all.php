
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
								<h3 class="page-title">Users</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/dashboard/default/">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">Users</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("9") || is_auth(21)){ ?>
								<a href="<?php echo base_url("/user/add_edit/"); ?>" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								</a>
								<?php }?>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					<!-- Search Filter -->
                    <form method="get" action="<?php echo base_url("/user/list_all/"); ?>">
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
							<?php cano_get_alert();?>
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
                                                    <td><?php echo $val['pin']; ?></td>
													<td><?php echo $val['email']; ?></td>
													<td><?php echo $val['mobile']; ?></td>
													<td><?php if(isset($user_type[$val['user_type']])){ echo $user_type[$val['user_type']]; } ?></td>
													<td><?php echo date('Y-m-d H:i:s', $val['created_on']); ?></td>
													<td><span class="badge badge-pill bg-<?php echo $status_color[$val['status']]; ?>-light"><?php echo $status[$val['status']]; ?></span></td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
																<!-- staff-->
																<?php if($user_type[$val['user_type']]=="Staff"){?>

																	<?php if(is_auth(8)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/user/view/" . $val['id']); ?>?mode=view">
																	<i class="far fa-solid fa-eye me-2"></i>View
																	</a>
																	<?php }?>
																	
																	<?php if(is_auth(10)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/user/add_edit/" . $val['id']); ?>">
																		<i class="far fa-edit me-2" ></i >Edit
																	</a>
																	<?php }?>

																	<?php if(is_auth(8)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/bank/list_all/" . $val['id']); ?>">
																		<i class="far fa-credit-card me-2" ></i >Bank Details
																	</a>
																	<?php }?>

																	<?php if(is_auth(11)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/user/delete/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
																		<i class="far fa-trash-alt me-2" ></i >Delete
																	</a>
																	<?php }?>

																<?php }?>

																
																<!-- Promoter-->
																<?php if($user_type[$val['user_type']]=="Promoter"){?>

																	<?php if(is_auth(20)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/user/view/" . $val['id']); ?>?mode=view">
																	<i class="far fa-solid fa-eye me-2"></i>View
																	</a>
																	<?php }?>
																	
																	<?php if(is_auth(22)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/user/add_edit/" . $val['id']); ?>">
																		<i class="far fa-edit me-2" ></i >Edit
																	</a>
																	<?php }?>

																	<?php if(is_auth(20)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/bank/list_all/" . $val['id']); ?>">
																		<i class="far fa-credit-card me-2" ></i >Bank Details
																	</a>
																	<?php }?>

																	<?php if(is_auth(23)){ ?>
																	<a class="dropdown-item" href="<?php echo base_url("/user/delete/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
																		<i class="far fa-trash-alt me-2" ></i >Delete
																	</a>
																	<?php }?>

																<?php }?>

															
															</div>
														</div>
													</td>
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
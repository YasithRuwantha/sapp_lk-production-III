
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
								<h3 class="page-title">Project</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Home</a>
									</li>
									<li class="breadcrumb-item active">Project</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("15")){ ?>
								<a href="<?php echo base_url("/project/add_edit/"); ?>" class="btn btn-primary me-1">
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
                    <form method="get" action="<?php echo base_url("/project/list_all/"); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Project Name</label>
										<?php $field_name = "project_name"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">									
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Project Type</label>
										<?php $field_name = "project_type"; ?>
										<select class="form-select" name="<?php echo $field_name; ?>">
											<option value="">-- Select --</option>
											<?php foreach($project_type as $key=>$val){ ?>
												<option <?php if(isset($_GET[$field_name]) && $key == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Incharge</label>
										<?php $field_name = "project_incharge_id"; ?>
										<select class="form-select" name="<?php echo $field_name; ?>">
											<option value="">-- Select --</option>
											<?php foreach($user_list as $key=>$val){ ?>
												<option <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['fname']; ?> <?php echo $val['lname']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Project Status</label>
										<?php $field_name = "project_status"; ?>
										<select class="form-select" name="<?php echo $field_name; ?>">
											<option value="">-- Select --</option>
											<?php foreach($project_status as $key=>$val){ ?>
												<option <?php if(isset($_GET[$field_name]) && $key == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
                            <div class="row">								
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
							<?php cano_get_alert(); ?>
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Project Name</th>
                                                    <th>Project Type</th>
													<th>Focal Point</th>
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
                                                    <td><?php echo $val['project_name']; ?></td>
													<td><?php if(isset($project_type[$val['project_type']])){ echo $project_type[$val['project_type']]; } ?></td>
													<td><?php echo $val['fname'] . " " . $val['lname']; ?></td>
													<td><span class="badge badge-pill bg-<?php echo $status_color[$val['project_status']]; ?>-light"><?php if(isset($project_status[$val['project_status']])){ echo $project_status[$val['project_status']]; } ?></span></td>
													
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="<?php echo base_url("/project/view/" . $val['id']); ?>?mode=view">
																	<span class="material-symbols-rounded">preview</span>View
																</a>
																<?php if(is_auth("16")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/project/add_edit/" . $val['id']); ?>">
																	<span class="material-symbols-rounded">rate_review</span>Edit
																</a>
																<?php }?>
																<?php if(is_auth("14")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/project_staff/list_all/" . $val['id'] . "/"); ?>">
																	<span class="material-symbols-rounded">group</span>Project Staff
																</a>
																<a class="dropdown-item" href="<?php echo base_url("/project_gnd/list_all/" . $val['id'] . "/"); ?>">
																	<span class="material-symbols-rounded">map</span>Project Gnd
																</a>
																<a class="dropdown-item" href="<?php echo base_url("/farmer_project/list_all/" . $val['id'] . "/"); ?>">
																	<span class="material-symbols-rounded">agriculture</span>Farmer Project
																</a>
																<a class="dropdown-item" href="<?php echo base_url("/project_extension/list_all/" . $val['id'] . "/"); ?>">
																	<span class="material-symbols-rounded">drive_file_move_outline</span>Project Extension
																</a>
																<a class="dropdown-item" href="<?php echo base_url("/project_target/list_all/" . $val['id'] . "/"); ?>">
																	<span class="material-symbols-rounded">folder</span>Project Target
																</a>
																<a href="<?php echo base_url("/geographic_locations/list_all/project/" . $val['id'] . "/"); ?>/" class="dropdown-item">
																	<span class="material-symbols-rounded">location_on</span> GEO Locations
																</a>
																<?php }?>
																<?php if(is_auth("17")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/project/delete/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
																	<span class="material-symbols-rounded">delete_forever</span>Delete
																</a>
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
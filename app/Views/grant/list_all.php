
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
								<h3 class="page-title">Grant</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a>
									</li>
                                    <!-- <li class="breadcrumb-item"><a href="<?php echo base_url("/grant/list_all/"); ?>">Grant Claim Group</a>
									</li> -->
									<li class="breadcrumb-item active">Grant Claim List</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("147")){ ?>
								<a href="<?php echo base_url("/grant/add_edit/"); ?>" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								</a>
								<?php } ?>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					<!-- Search Filter -->
                    <form method="post" action="<?php echo base_url("/grant/list_all/"); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Grant</label>
										<?php $field_name = "grant_name"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_POST[$field_name])){ echo $_POST[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Project</label>
										<?php $field_name = "project_name"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_POST[$field_name])){ echo $_POST[$field_name]; } ?>" type="text" class="form-control">
								
									</div>
								</div>
							</div>
                            <div class="row">
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
							<?php cano_get_alert(); ?>
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Claim No</th>
                                                    <th>Project</th>
													<th>Item Name</th>
													<th>Remarks</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['grant_name']; ?></td>
                                                    <td><?php echo $val['project_name']; ?></td>
                                                    <td><?php echo $val['item_description']; ?></td>
                                                    <td><?php echo $val['grant_details']; ?></td>
                                                    <td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
																<?php if(is_auth("148")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/grant/add_edit/" . $val['id']); ?>">
																<i class="far fa-edit me-1"></i>Edit
																</a>
																<?php } ?>
																<?php if(is_auth("146")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/grant_disbursement/group_list_all/" . $val['id'] . "/"); ?>">
																<i class="far fa-file me-1"></i>Grant Disbursement
																</a>
																<?php } ?>
																<?php if(is_auth("149")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/grant/delete/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
																<i class="far fa-trash-alt me-1"></i>Delete
																</a>
																<?php } ?>
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

<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?php

        use function PHPUnit\Framework\isEmpty;

 echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.css"); ?>">
		
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
								<h3 class="page-title">Grant Disbursement</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/grant/list_all/"); ?>">Grant Claim Group</a>
									</li>
									<li class="breadcrumb-item active">Grant Disbursement</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("147")){ ?>
								<a href="<?php echo base_url("/grant_disbursement/group_add_edit/" . $entity_id); ?>" class="btn btn-primary me-1" id="add-btn">
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
                    <form method="get" action="<?php echo base_url("/grant_disbursement/group_list_all/" . $entity_id); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Remarks</label>
										<?php $field_name = "remarks"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Status</label>
										<?php $field_name = "disbursement_status"; ?>
										<select class="form-select" name="<?php echo $field_name; ?>">
											<option value="">-- Select --</option>
											<?php foreach($disbursement_status as $key=>$val){ ?>
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

                    <?php cano_get_alert(); ?>
					<div class="row">
						<div class="col-sm-12">
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Item</th>
                                                    <th>Status</th>
													<th>Category</th>
													<th>Per Farmer QTY</th>
													<th>Date Of Grant</th>
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
                                                    <td><?php if(strlen($val['item_description'])>0){ echo $val['item_description']; }else{ echo $val['remarks']; } ?></td>
                                                    <td><?php echo $disbursement_status[$val['disbursement_status']]; ?></td>
                                                    <td><?php echo $val['category_name']; ?></td>
                                                    <td><?php echo $val['per_farmer_qty']; ?></td>
                                                    <td><?php echo $val['date_of_grant']; ?></td>
                                                    <td><?php echo $val['remarks']; ?></td>
                                                    <td class="text-right">
                                                    <div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
																<?php if(is_auth("146")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/grant_disbursement/view/" . $entity_id . "/" . $val['id']); ?>?mode=view">
																	<span class="material-symbols-rounded">preview</span>View
																</a>
																<?php }?>
																<?php if(is_auth("148")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/grant_disbursement/group_add_edit/" . $entity_id . "/" . $val['id']); ?>">
																	<span class="material-symbols-rounded">rate_review</span>Edit
																</a>
																<?php }?>
																<?php if(is_auth("149")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/grant_disbursement/delete/" . $entity_id . "/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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

		<script>
			$(document).ready(function () {
				// if($(".datatable").find("tr").length > 0){
					<?php 
					if(isset($list_all) && is_array($list_all)){
                    	foreach($list_all as $val){
							if(isEmpty($val['item_description'])){
					?>
								$('#add-btn').hide();
					<?php 	
							}
						}
					} 
					?>
			});
			
		</script>
        
	</body>
</html>
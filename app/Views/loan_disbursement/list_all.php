
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
								<h3 class="page-title">Loan</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Home</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/loan/list_all/"); ?>">Loan</a>
									</li>
									<li class="breadcrumb-item active">Loan Disbursement</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("141")){ ?>
								<a href="<?php echo base_url("/loan_disbursement/add_edit/" . $loan_id); ?>" class="btn btn-primary me-1">
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
                    <form method="post" action="<?php echo base_url("/loan_disbursement/list_all/" . $loan_id); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Scheme Name</label>
										<?php $field_name = "loan_scheme_name"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_POST[$field_name])){ echo $_POST[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>CBSL Reg No.</label>
										<?php $field_name = "cbsl_reg_no"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_POST[$field_name])){ echo $_POST[$field_name]; } ?>" type="text" class="form-control">
									
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
							<?php cano_get_alert();?>
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Scheme Name</th>
                                                    <th>CBSL Reg No</th>
													<th>Disbursed Amount</th>
													<th>Loan Disbursement Status</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all_with_beneficiary) && is_array($list_all_with_beneficiary)){
                                                foreach($list_all_with_beneficiary as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['beneficiary_name']; ?></td>
                                                    <td><?php echo $val['cbsl_reg_no']; ?></td>
                                                    <td><?php echo $val['actual_loan_amount']; ?></td>
                                                    <td><?php 
														foreach($disbursement_status as $key=>$status){
															if($val['disbursement_status']==$key){
																echo $status;
															}
														}
													?></td>
                                                    <td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
																<?php if(is_auth("140")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/loan_disbursement/view/" . $loan_id . "/" . $val['id']); ?>?mode=view">
																	<span class="material-symbols-rounded">visibility</span>View
																</a>
																<?php }?>
																<?php if(is_auth("142")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/loan_disbursement/add_edit/" . $loan_id . "/" . $val['id']); ?>/">
																	<span class="material-symbols-rounded">rate_review</span>Edit
																</a>
																<?php }?>
																<?php if(is_auth("143")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/loan_disbursement/delete/" . $loan_id . "/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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
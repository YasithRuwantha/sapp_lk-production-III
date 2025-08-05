
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
								<h3 class="page-title">Matching Grant Payment</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/matching_grant_development/list_all/"); ?>">Matching Grant Development</a>
									</li>
									<li class="breadcrumb-item active">Matching Grant Payment</li>
								</ul>
							</div>
							<div class="col-auto">
							<?php if(is_auth("153")){ ?>
								<a href="<?php echo base_url("/matching_grant_payment/add_edit/" . $entity_id); ?>" class="btn btn-primary me-1">
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
                    <form method="get" action="<?php echo base_url("/matching_grant_payment/list_all/" . $entity_id); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Payment date</label>
										<?php $field_name = "payment_date"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="datepicker form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Payment amount</label>
										<?php $field_name = "payment_amount"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Remarks</label>
										<?php $field_name = "remarks"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">
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
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Matching Grant Activity</th>
													<th>Payment date</th>
                                                    <th>Payment amount</th>
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
													<td><?php echo $val['activity']; ?></td>
                                                    <td><?php echo $val['payment_date']; ?></td>
                                                    <td><?php echo $val['payment_amount']; ?></td>
													<td><?php echo $val['remarks']; ?></td>
                                                    <td class="text-right">
													<?php if(is_auth("154")){ ?>
														<a href="<?php echo base_url("/matching_grant_payment/add_edit/" . $entity_id . "/" . $val['id']); ?>" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 														
													<?php } ?>
													<?php if(is_auth("155")){ ?>
														<a href="<?php echo base_url("/matching_grant_payment/delete/" . $entity_id . "/" . $val['id']); ?>" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													<?php } ?>
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
		$( function() {
            <?php $field_name = "date_of_grant"; ?>
			$( ".datepicker" ).datepicker({ minDate: "-1Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".datepicker" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);
		});
		</script>
        
	</body>
</html>
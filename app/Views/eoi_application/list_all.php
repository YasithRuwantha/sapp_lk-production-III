
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
								<h3 class="page-title">EOI</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Home</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/eoi/list_all/"); ?>">Eoi</a>
									</li>
									<li class="breadcrumb-item active">EOI Application</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("99")){ ?>
								<a href="<?php echo base_url("/eoi_application/add_edit/" . $eoi_id); ?>" class="btn btn-primary me-1">
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
                    <form method="post" action="<?php echo base_url("/eoi_application/list_all/" . $eoi_id); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>EOI Name</label>
										<?php $field_name = "eoi_name"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_POST[$field_name])){ echo $_POST[$field_name]; } ?>" type="text" class="form-control">
									
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Name</label>
										<?php $field_name = "full_name"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_POST[$field_name])){ echo $_POST[$field_name]; } ?>" type="text" class="form-control">
									
									</div>
								</div>
							</div>
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
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
													<th>EOI Name</th>
                                                    <th>Name</th>
													<th>Acknowladgement Date</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['eoi_name']; ?></td>
                                                    <td><?php echo $val['first_name']; ?> <?php echo $val['last_name']; ?></td>
                                                    <td><?php echo $val['bp_application_acknowladgement_date']; ?></td>
                                                    <td class="text-right">
														<?php if(is_auth("98")){ ?>
														<a class="btn btn-sm btn-white text-success me-2" href="<?php echo base_url("/eoi_application/view/" . $eoi_id . "/" . $val['id']); ?>?mode=view">
														<i class="far fa-solid fa-eye me-2"></i>View
														</a>
														<?php } ?>
														<?php if(is_auth("100")){ ?>
														<a href="<?php echo base_url("/eoi_application/add_edit/" . $eoi_id . "/" . $val['id']); ?>" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 														
                                                        <?php } ?>
														<?php if(is_auth("101")){ ?>
														<a href="<?php echo base_url("/eoi_application/delete/" . $eoi_id . "/" . $val['id']); ?>" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
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
        
	</body>
</html>

<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.css"); ?>">
		<style>
			.pagination-overall {
				display: flex;
				justify-content: center;
				padding-bottom: 10px;
				list-style: none;
			}

			.pagination-overall li {
				margin: 0 5px;
			}

			.pagination-overall a {
				color: #9e1d1d;
				text-decoration: none;
				padding: 8px 16px;
				border: 1px solid #9e1d1d;
				border-radius: 4px;
				transition: background-color 0.3s, color 0.3s;
			}

			.pagination-overall a:hover {
				background-color: #9e1d1d;
				color: white;
			}

			.pagination-overall .active a {
				background-color: #9e1d1d;
				color: white;
				border-color: #9e1d1d;
			}

			.pagination-overall .disabled a {
				color: #ccc;
				pointer-events: none;
				border-color: #ccc;
			}

			.pagination-info {
				margin-top: 10px;
				text-align: center;
			}

	</style>
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
								<h3 class="page-title">Farmer Project</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Home</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/project/list_all/"); ?>">Project</a>
									</li>
									<li class="breadcrumb-item active">Farmer Project</li>
								</ul>
							</div>
							<div class="col-auto">
							<?php if(is_auth("15")){ ?>
								<a href="<?php echo base_url("/farmer_project/add_edit/" . $entity_id); ?>" class="btn btn-primary me-1">
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
                    <form method="get" action="<?php echo base_url("/farmer_project/list_all/" . $entity_id); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>First name</label>
										<?php $field_name = "fname"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Last name</label>
										<?php $field_name = "lname"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>obtained Benefit</label>
										<?php $field_name = "obtained_benifit"; ?>
										<select class="<?php echo $field_name; ?> search-select form-select entity-type" name="<?php echo $field_name; ?>">
												<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
													<?php foreach($obtained_benifit as $key=>$val){ ?>
													<option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
												 <?php } ?>
										</select>
									</div>
								</div>
								
							</div>
                            <div class="row">
								<div class="col-sm-6 col-md-3">
								</div>
								<div class="col-sm-6 col-md-3">
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
					<?php cano_get_alert(); ?>
					<div class="row">
						<div class="col-sm-12">
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Farmer Name</th>
                                                    <th>NIC No</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['fname'].' '.$val['lname']; ?></td>
                                                    <td><?php echo $val['pin']; ?></td>
                                                    <td class="text-right">
													<?php if(is_auth("16")){ ?>
														<a href="<?php echo base_url("/farmer_project/add_edit/" . $entity_id . "/" . $val['farmer_id']); ?>" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 														
                                                    <?php } ?>    
													<?php if(is_auth("17")){ ?>
														<a href="<?php echo base_url("/farmer_project/delete/" . $entity_id . "/" . $val['farmer_id']); ?>" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
													<?php } ?>
													</td>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											</tbody>
										</table>
										<div class="pagination-container">
											<p class="pagination-info">Showing <?= $start ?> to <?= $end ?> of <?= $total ?> entries</p>
											<ul class="pagination-overall">
												<?= $pager_links ?>
											</ul>
										</div> 
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
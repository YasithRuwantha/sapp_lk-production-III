
<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.css"); ?>">

		<!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">
		
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
								<h3 class="page-title">Bank Details</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a>
									</li>
									<?php if($mode=="user"){ ?>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/user/list_all/"); ?>">User</a>
									</li>
									<?php } ?>
									<?php if($mode=="promoter"){ ?>
									<li class="breadcrumb-item"><a href="<?php echo base_url("/promoter/list_all/"); ?>">Promoter</a>
									</li>
									<?php } ?>
									<li class="breadcrumb-item active">Bank Details</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if($mode=="user" && (is_auth("171") || is_auth("9"))){ ?>
                                    <a href="<?php echo base_url("/bank/add_edit/" . $entity_id); ?>/user" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								<?php } ?>
								<?php if($mode=="promoter" && is_auth("21")){ ?>
                                    <a href="<?php echo base_url("/bank/add_edit/" . $entity_id); ?>/promoter" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								<?php } ?>
								
								</a>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					<!-- Search Filter -->
                    <form method="get" action="<?php echo base_url("/bank/list_all/" . $entity_id . "/" . $mode); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Account No</label>
										<?php $field_name = "acc_no"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="form-control">
									</div>
								</div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Bank name</label>
										<div class="col-sm-10">
											<?php $field_name = "bank_id"; ?>
											<select class="search-select form-select entity-type" name="<?php echo $field_name; ?>">
												<?php if(!isset($_GET[$field_name])){ ?>
													<option value="">-- Select --</option>
												<?php } ?>
												<?php foreach($bank_id as $key=>$val){ ?>
													<option <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['bank']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
										
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Branch</label>
										<?php $field_name = "branch"; ?>
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
													<th>Account No</th>
                                                    <th>Bank</th>
                                                    <th>Branch</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['acc_no']; ?></td>
                                                    <td><?php echo $val['bank']; ?></td>
                                                    <td><?php echo $val['branch']; ?></td>
                                                    <td class="text-right">
													<?php if(is_auth("172") || is_auth("10") || is_auth("22")){ ?>
														<a href="<?php echo base_url("/bank/add_edit/" . $entity_id . "/" . $val['id'] . "/" . $mode); ?>" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 														
													<?php } ?>
													<?php if(is_auth("173") || is_auth("11") || is_auth("23")){ ?>
														<a href="<?php echo base_url("/bank/delete/" . $entity_id . "/" . $val['id'] . "/" . $mode); ?>" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
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

		<!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

        <script>
		$( function() {
			$(".search-select").select2();
		});
		</script>
        
	</body>
</html>
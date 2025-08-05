
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
								<h3 class="page-title">IS</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/is/list_all/"); ?>">IS</a>
									</li>
									<li class="breadcrumb-item active">IS List</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("129")){ ?>
								<a href="<?php echo base_url("/is/add_edit/"); ?>" class="btn btn-primary me-1">
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
                    <form method="get" action="<?php echo base_url("/is/list_all/"); ?>" enctype="multipart/form-data">
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Service provider</label>
										<?php $field_name = "is_service_provider_id"; ?>
                                        <select class="<?php echo $field_name; ?> search-select form-select entity-type" name="<?php echo $field_name; ?>">
                                            <?php foreach($is_service_provider_id as $key=>$val){ ?>
                                                <option <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['name_service_provider']; ?></option>
                                            <?php } ?>
                                        </select>
									</div>
                                    <div class="form-group">
										<label>Promoter</label>
										<?php $field_name = "promoter_id"; ?>
                                        <select class="<?php echo $field_name; ?> search-select form-select entity-type" name="<?php echo $field_name; ?>">
                                            <?php foreach($promoter_id as $key=>$val){ ?>
                                                <option <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['org_name']; ?></option>
                                            <?php } ?>
                                        </select>
									</div>
                                    <div class="form-group">
										<label>Project</label>
										<?php $field_name = "project_id"; ?>
                                        <select class="<?php echo $field_name; ?> search-select form-select entity-type" name="<?php echo $field_name; ?>">
                                            <?php foreach($project_id as $key=>$val){ ?>
                                                <option <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['project_name']; ?></option>
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
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Name of Service Provider</th>
                                                    <th>Organization name</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['name_service_provider']; ?></td>
                                                    <td><?php echo $val['org_name']; ?></td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
																<?php if(is_auth("128")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/is/view/" . $val['id']); ?>?mode=view">
																<i class="far fa-solid fa-eye me-2"></i>View
																</a>
																<?php } ?>
																<?php if(is_auth("130")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/is/add_edit/" . $val['id']); ?>">
																	<i class="far fa-edit me-2" ></i >Edit
																</a>
																<?php }?>
																<?php if(is_auth("128")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/is_activities/list_all/" . $val['id'] . "/"); ?>">
																	<i class="far fa-wrench me-2" ></i >IS Activities
																</a>
																<?php }?>
																<?php if(is_auth("131")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/is/delete/" . $val['id'] . "/"); ?>">
																	<i class="far fa-trash-alt me-2" ></i >Delete
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
        <!-- Select 2 -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

<script>
$( function() {
	$(".search-select").select2();
});
</script>
	</body>
</html>
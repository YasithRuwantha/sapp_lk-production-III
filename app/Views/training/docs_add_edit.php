
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
								<h3 class="page-title">Training</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/training/list_all/"); ?>">Training</a>
									</li>
									<li class="breadcrumb-item active">Training Docs</li>
								</ul>
							</div>
							<div class="col-auto">
							<?php if(is_auth("27")){ ?>
								<a href="<?php echo base_url("/training/docs_add_edit/" . $id . "/"); ?>" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								</a>
								<?php }?>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					
                    <div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Training Docs</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/training/docs_add_edit/" . $id . "/" . $resid); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row form-group">
                                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label">Doc type</label>
                                                    <div>
                                                        <?php $field_name = "doc_type"; ?>
                                                        <input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                        <?php if($validation->hasError($field_name)){ ?>
                                                        <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row form-group">
                                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label">Remarks</label>
                                                    <div>
                                                        <?php $field_name = "remarks"; ?>
                                                        <input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                        <?php if($validation->hasError($field_name)){ ?>
                                                        <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row form-group">
                                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label">Document</label>
                                                    <div>
                                                        <input type="file" placeholder="" class="form-control" id="field-label-<?php echo $inc++; ?>" name="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>
									<!-- /Form -->
								</div>
							</div>							
						</div>
					</div>


					<div class="row">
						<div class="col-sm-12">							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Doc Type</th>
                                                    <th>Remarks</th>
													<th>Training Doc</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['doc_type']; ?></td>
													<td><?php echo $val['remarks']; ?></td>
                                                    <td>
                                                        <?php
                                                        $path = s3_tmp_url(substr($val['relative_path'],1));
                                                        ?>
                                                        <a href="<?php echo $path; ?>" target="_blank" class="btn btn-sm btn-white text-purple me-2"><i class="far fa-file me-1"></i> Download</a>
                                                    </td>
                                                    <td class="text-right">
													<?php if(is_auth("28")){ ?>
                                                        <a href="<?php echo base_url("/training/docs_add_edit/" . $id . "/" . $val['id']); ?>" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
													<?php } ?>
													<?php if(is_auth("29")){ ?>
														<a href="<?php echo base_url("/training/docs_delete/" . $id . "/" . $val['id']); ?>" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt me-1"></i>Delete</a>
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
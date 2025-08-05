<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/css/bootstrap-datetimepicker.min.css"); ?>">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
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
					<div class="page-header">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="page-title">Settings</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/user/list_all/"); ?>">Users</a>
									</li>
									<li class="breadcrumb-item active">Farmer Project</li>
								</ul>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-xl-3 col-md-4">
						
							<!-- Settings Menu -->
							<div class="widget settings-menu">
								<ul>
									<li class="nav-item">
										<a href="<?php echo base_url("/user/add_edit/" . $id); ?>" class="nav-link">
											<i class="far fa-user"></i> <span>Basic Info</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url("/user/farmer/" . $id); ?>" class="nav-link">
											<i class="far fa-address-card"></i> <span>Farmer</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url("/farmer/project_update/" . $id); ?>" class="nav-link active">
											<i class="far fa-file"></i> <span>Project</span>
										</a>
									</li>
								</ul>
							</div>
							<!-- /Settings Menu -->							
						</div>
						
						<div class="col-xl-9 col-md-8">						
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Farmer Project</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("farmer/project_update/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">Project</label>
											<div class="col-sm-9">
                                                <?php $field_name = "project_id"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php 
                                                    if(isset($project_list) && is_array($project_list)){
                                                        foreach($project_list as $key=>$val){ 
                                                    ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['project_name']; ?></option>
                                                    <?php }} ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Contribution</label>
											<div class="col-sm-9">
                                                <?php $field_name = "contribution"; ?>
												<input type="text" placeholder="Contribution" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Purpose</label>
											<div class="col-sm-9">
                                                <?php $field_name = "purpose"; ?>
												<input type="text" placeholder="Purpose" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">VCM recomendation</label>
											<div class="col-sm-9">
                                                <?php $field_name = "vcm_recomendation"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($vcm_recomendation as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">VCM recomendation remarks</label>
											<div class="col-sm-9">
                                                <?php $field_name = "vcm_recomendation_remark"; ?>
												<input type="text" placeholder="VCM remarks" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">RPC recomendation</label>
											<div class="col-sm-9">
                                                <?php $field_name = "rpc_recomendation"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($rpc_recomendation as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">RPC recomendation remarks</label>
											<div class="col-sm-9">
                                                <?php $field_name = "rpc_recomendation_remark"; ?>
												<input type="text" placeholder="RPC remarks" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">Liason recomendation</label>
											<div class="col-sm-9">
                                                <?php $field_name = "liason_recomendation"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($liason_recomendation as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Liason recomendation remarks</label>
											<div class="col-sm-9">
                                                <?php $field_name = "liason_recomendation_remark"; ?>
												<input type="text" placeholder="Liason remarks" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">VCM approval date</label>											<div class="col-sm-9">
                                                <?php $field_name = "vcm_approval_date_time"; ?>
												<input type="text" placeholder="yyyy-mm-dd hh:mm:ss" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">RPC approval date</label>											<div class="col-sm-9">
                                                <?php $field_name = "rpc_approval_date_time"; ?>
												<input type="text" placeholder="yyyy-mm-dd hh:mm:ss" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Liason approval date</label>											<div class="col-sm-9">
                                                <?php $field_name = "liason_approval_date_time"; ?>
												<input type="text" placeholder="yyyy-mm-dd hh:mm:ss" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">Project status</label>
											<div class="col-sm-9">
                                                <?php $field_name = "project_status"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($project_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">Eligible status</label>
											<div class="col-sm-9">
                                                <?php $field_name = "eligible_status"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($eligible_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-3">Obtained benifit</label>
											<div class="col-sm-9">
                                                <?php $field_name = "obtained_benifit"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($obtained_benifit as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">PFI Ref No</label>											<div class="col-sm-9">
                                                <?php $field_name = "pfi_ref_no"; ?>
												<input type="text" placeholder="PFI No" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
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
		
		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</body>
</html>
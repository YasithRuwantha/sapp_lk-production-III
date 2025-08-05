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
									<li class="breadcrumb-item"><a href="/dashboard/default/">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">Profile Settings</li>
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
										<a href="<?php echo base_url("/user/profile/"); ?>" class="nav-link active">
											<i class="far fa-user"></i> <span>Basic Info</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url("/user/change_password/"); ?>" class="nav-link">
											<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url("/staff_leave/list_mine/"); ?>" class="nav-link">
											<i class="fas fa-unlock-alt"></i> <span>Leaves Obtained</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url("/fixed_assert/list_mine/"); ?>" class="nav-link">
											<i class="fas fa-unlock-alt"></i> <span>Inventory</span>
										</a>
									</li>
								</ul>
							</div>
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
						
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Basic information</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/user/profile/"); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
                                        <div class="row form-group">
                                            <label for="profile" class="col-sm-3 col-form-label input-label">Profile picture</label>
											<div class="col-sm-9">
												<div class="d-flex align-items-center">
													<label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
														<img id="avatarImg" class="avatar-img" src="<?php echo base_url($record['relative_path']); ?>" alt="Profile Image">
														<input type="file" id="edit_img" name="img">
														<span class="avatar-edit">
															<i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
														</span>
													</label>
												</div>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">First name</label>
											<div class="col-sm-9">
                                                <?php $field_name = "fname"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="First name">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Last name</label>
											<div class="col-sm-9">
                                                <?php $field_name = "lname"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Last name">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Personal identification no (NIC)</label>
											<div class="col-sm-9">
                                                <?php $field_name = "pin"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="NIC/Passport">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Email</label>
											<div class="col-sm-9">
                                                <?php $field_name = "email"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Email">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Phone</label>
											<div class="col-sm-9">
                                                <?php $field_name = "mobile"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Mobile">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Date of birth</label>
											<div class="col-sm-9">
                                                <?php $field_name = "dob"; ?>
												<input type="text" class="datepicker form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="yyyy-mm-dd">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-gen" class="col-sm-3 col-form-label input-label">Gender</label>
											<div class="col-sm-9">
                                                <?php $field_name = "gender"; ?>
												<div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==1){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="gender" value="1">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Male</label>
												</div>
												<div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==2){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="gender" value="2">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Female</label>
												</div>
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

		<script>
		$( function() {
			$( ".datepicker" ).datepicker({ minDate: "-90Y", maxDate: "-18Y", changeMonth: true, changeYear: true });
			$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".datepicker" ).val( "<?php if(isset($record['dob'])){ echo $record['dob']; } ?>" ), 200);
		} );
		</script>
	</body>
</html>
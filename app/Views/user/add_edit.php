<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php

        use function PHPUnit\Framework\isEmpty;

 echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">
		
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
									<li class="breadcrumb-item">
									<?php if(isset($_GET['user_type']) && $_GET['user_type']==2){ 
												echo '<a href="' . base_url("/user/farmer_project?user_type=2") . '">Beneficiaries</a>'; 
											}
											else{ 
												echo '<a href="' . base_url("/user/list_all/") . '">Users</a>';  
											} 
											?>

									</li>
									<li class="breadcrumb-item active"><?php if(isset($_GET['user_type']) && $_GET['user_type']==2){ echo "Beneficiary Details "; }else{ echo "User Details"; } ?></li>
								</ul>
							</div>

                            <?php
                            if(isset($record["user_type"]) && $record["user_type"]==2 && is_auth(171)){
                            ?>
                                <div class="col-auto">
                                    <a href="<?php echo base_url("/user/generate_template/"); ?>">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary bulk-button">
                                                <i class="fa fa-download"></i> Template</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="<?php echo base_url("/user/resource_generate/"); ?>">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary bulk-button">
                                                <i class="fa fa-download"></i> Resource</button>
                                        </div>
                                    </a>
                                </div>
                            <?php }?>


						</div>
					</div>
				
					<div class="row">
						<div class="col-xl-3 col-md-4">
						
							<!-- Settings Menu -->
							<div class="widget settings-menu">
								<ul>
									<li class="nav-item">
										<a id="basic-info" href="<?php echo base_url("/user/add_edit/" . $id); ?>" class="nav-link active">
											<i class="far fa-user"></i> <span>Basic Info</span>
										</a>
									</li>
									<?php if(isset($record["user_type"]) && $record["user_type"]==1){ ?>
									<li class="nav-item">
										<a id="staff-meta" href="<?php echo base_url("/user/staff_meta/" . $id); ?>" class="nav-link">
											<i class="far fa-address-card"></i> <span>Staff Meta</span>
										</a>
									</li>
									<?php } ?>
									<?php if(isset($record["user_type"]) && $record["user_type"]==2){ ?>
									<li class="nav-item">
										<a id="farmer-meta" href="<?php echo base_url("/user/farmer/" . $id); ?>" class="nav-link">
											<i class="far fa-address-card"></i> <span>Farmer Meta</span>
										</a>
									</li>
									<li class="nav-item">
										<a id="farmer-approvals" href="<?php echo base_url("/user/approvals/" . $id); ?>" class="nav-link">
											<i class="far fa-address-card"></i> <span>Approvals</span>
										</a>
									</li>
									<?php } ?>
									<?php if(isset($record["user_type"]) && $record["user_type"]==2 && FALSE){ ?>
									<li class="nav-item">
										<a href="<?php echo base_url("/farmer/project_update/" . $id); ?>" class="nav-link">
											<i class="far fa-file"></i> <span>Project</span>
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
						<?php cano_get_alert(); ?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Basic information</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/user/add_edit/" . $id); ?><?php if(isset($record["user_type"]) && $record["user_type"]==2){ echo "?user_type=2"; } ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
                                        <?php if(isset($_GET['user_type']) && $_GET['user_type']==2){ ?>
                                        <input name="user_type" value="2" type="hidden">
                                        <?php } elseif(isset($record["user_type"])){ ?>
                                        <input name="user_type" value="<?php echo $record["user_type"]; ?>" type="hidden">
                                        <?php } ?>
                                        <div class="row form-group">
                                            <label for="profile" class="col-sm-3 col-form-label input-label">Profile picture</label>
											<div class="col-sm-9">
												<div class="d-flex align-items-center">
													<label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
														<img id="avatarImg" class="avatar-img" src="<?php if(isset($record['relative_path'])){ echo base_url($record['relative_path']); }else{ echo base_url("/public/resource/common/placeholder.png"); } ?>" alt="Profile Image">
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
												<input type="text" class="nic form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="NIC/Passport">
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
												<input type="text" class="dob datepicker form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="yyyy-mm-dd">
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
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==1){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="<?php echo $field_name; ?>" value="1">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Male</label>
												</div>
												<div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==2){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="<?php echo $field_name; ?>" value="2">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Female</label>
												</div>
												<?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<?php 
										if(isset($record["user_type"]) && $record["user_type"]==2){
										?>
											<input name="status" value="1" type="hidden">
										<?php }else{ ?>
                                        <div class="row form-group">
											<label for="field-label-gen" class="col-sm-3 col-form-label input-label">Status</label>
											<div class="col-sm-9">
                                                <?php $field_name = "status"; ?>
												<div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==1){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="<?php echo $field_name; ?>" value="1">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Active</label>
												</div>
												<div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==2){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="<?php echo $field_name; ?>" value="2">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Suspended</label>
												</div>
                                                <div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==3){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="<?php echo $field_name; ?>" value="3">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">Pending</label>
												</div>
                                                <div class="form-check">
												  	<input type="radio"<?php if(isset($record[$field_name]) && $record[$field_name]==4){ ?> checked<?php } ?> class="form-check-input<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc; ?>" name="<?php echo $field_name; ?>" value="4">
												  	<label class="form-check-label" for="field-label-<?php echo $inc++; ?>">In-active</label>
												</div>
												<?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<?php } ?>
										<?php 
										if(isset($record["user_type"]) && $record["user_type"]==2){
										?>
											<input name="pass" value="tmppass<?php echo rand(1,999999); ?>" type="hidden">
										<?php }else{ ?>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Password</label>
											<div class="col-sm-9">
                                                <?php $field_name = "pass"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="" placeholder="Password">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<?php } ?>
										<?php 
										if(isset($record["user_type"]) && $record["user_type"]==2){
										?>
											<input name="user_type" value="<?php echo $record["user_type"]; ?>" type="hidden">
										<?php }else{ ?>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">User type</label>
											<div class="col-sm-9">
                                                <?php $field_name = "user_type"; ?>
												<div class="col-md-10">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($user_type as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
										<?php } ?>
										<?php 
										if(isset($record["user_type"]) && $record["user_type"]==2){
										?>
											<input name="user_group[]" value="3" type="hidden">
										<?php }else{ ?>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">User groups</label>
											<div class="col-sm-9">
                                                <?php $field_name = "user_group[]"; ?>
												<div class="col-md-10">
												<select multiple class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php foreach($user_group as $key=>$val){ ?>
                                                        <option <?php if(isset($my_user_group) && in_array($val['id'],$my_user_group)){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['group_name']; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
										<?php } ?>

										<?php 
										if((isset($record["user_type"]) && $record["user_type"]==2) || (isset($_GET['user_type']) && $_GET['user_type']==2)){
										?>

										<!-- District Field -->
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">District</label>
											<div class="col-sm-9">
												<?php $field_name = "district_id"; ?>
												<?php if(isset($_GET['mode']) && $_GET['mode'] == 'view'){ ?>
													
													<p class="form-control-plaintext">
														<?php 
														$district_name = '';
														if(isset($record[$field_name]) && isset($farmer_district_list)){
															foreach($farmer_district_list as $d){
																if((string)$d['id'] === (string)$record[$field_name]){
																	$district_name = $d['district'];
																	break;
																}
															}
														}
														echo $district_name ? $district_name : '-';
														?>
													</p>
												<?php } else { ?>
													<select class="form-select district-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="district-select" name="<?php echo $field_name; ?>">
														<?php if(!isset($record[$field_name]) || empty($record[$field_name])){ ?>
															<option value="">-- Select District --</option>
														<?php } ?>
														<?php if(isset($farmer_district_list)){ foreach($farmer_district_list as $key=>$val){ ?>
															<option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['district']; ?></option>
														<?php }} ?>
													</select>
													<?php if($validation->hasError($field_name)){ ?>
													<div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
													<?php } ?>
												<?php } ?>
											</div>
										</div>


										<!-- DSD Field -->
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">DSD</label>
											<div class="col-sm-9">
												<?php $field_name = "dsd_id"; ?>
												<?php if(isset($_GET['mode']) && $_GET['mode'] == 'view'){ ?>
													
													<p class="form-control-plaintext">
														<?php 
														$dsd_name = '';
														if(isset($record[$field_name]) && isset($farmer_dsd_list)){
															foreach($farmer_dsd_list as $d){
																if((string)$d['id'] === (string)$record[$field_name]){
																	$dsd_name = $d['dsd'];
																	break;
																}
															}
														}
														echo $dsd_name ? $dsd_name : '-';
														?>
													</p>
												<?php } else { ?>
													<select class="form-select dsd-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="dsd-select" name="<?php echo $field_name; ?>">
														<option value="">-- Select DSD --</option>
														<?php if(isset($record[$field_name]) && !empty($record[$field_name]) && isset($farmer_dsd_list)){
															foreach($farmer_dsd_list as $key=>$val){
																if((isset($record['district_id']) && $val['district_id'] == $record['district_id']) || !isset($record['district_id'])){ ?>
																	<option <?php if($val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['dsd']; ?></option>
																<?php }
															}
														} ?>
													</select>
													<?php if($validation->hasError($field_name)){ ?>
													<div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
													<?php } ?>
												<?php } ?>
											</div>
										</div>

										<!-- GND Field -->
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">GND</label>
											<div class="col-sm-9">
                                                <?php $field_name = "gnd_id"; ?>
												<select class="search-select form-select gnd-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="gnd-select" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name]) || empty($record[$field_name])){ ?>
														<option value="">-- Select GND --</option>
													<?php } ?>
                                                    <?php foreach($gnd_list as $key=>$val){ ?>
                                                        <option class="entity gnd-option" data-dsd-id="<?php echo $val['dsd_id']; ?>" <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['gnd']; ?></option>
													<?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Agrarian Division</label>
											<div class="col-sm-9">
                                                <?php $field_name = "aggrarian_division_id"; ?>
												<select class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name]) || empty($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($agg_list as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
													<?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<?php } ?>

										<div class="text-end">
											<button type="submit" class="btn btn-primary save-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Form -->

                                    <?php
                                    if(isset($record["user_type"]) && $record["user_type"]==2 && is_auth(171)){
                                    ?>

                                    <br>
                                    <!--Bulk Upload Option-->
                                    <form action="<?php echo base_url('user/bulk_upload/') ?>" method="POST"
                                          enctype="multipart/form-data">
                                        <div class="form-group ">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Bulk
                                                upload</label>
                                            <input type="file" name="excel_file" accept=".xlsx, .xls" required>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>

                                    <?php } ?>
									
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

		<!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

		<script>
		$( function() {
			$( ".datepicker" ).datepicker({ minDate: "-90Y", maxDate: "-18Y", changeMonth: true, changeYear: true });
			$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".datepicker" ).val( "<?php if(isset($record['dob'])){ echo $record['dob']; } ?>" ), 200);

			$(".search-select").select2();

			QueryString = (new URL(location.href)).searchParams.get('mode');

        	if(QueryString){
        	    $('.btn').hide();
				$('.form-control').attr("disabled", "disabled");
				$('.form-control').removeAttr("placeholder");
				$('.form-select').attr("disabled", "disabled");
				$('.form-check-input').attr("disabled", "disabled");
				$('#basic-info').attr('href', '<?php echo base_url("/user/view/" . $id); ?>?user_type=2&mode=view');
				$('#farmer-meta').attr('href', '<?php echo base_url("/user/farmer/" . $id); ?>?mode=view');
				$('#farmer-approvals').attr('href', '<?php echo base_url("/user/approvals/" . $id); ?>?mode=view');
				$('#staff-meta').attr('href', '<?php echo base_url("/user/staff_meta/" . $id); ?>?mode=view');
			}

			// desable user type option retated is_auth()
			
			<?php if(!is_auth(21)){?>
				$("select option[value='4']").attr('disabled',"disabled");
			<?php } ?>

			<?php if(!is_auth(9)){?>
				$("select option[value='1']").attr('disabled',"disabled");

			<?php }?>

		});
		</script>

		<script>
			$(document).ready(function(){
				// if $id is 0 then desabled the #farmer-meta
				if("<?php echo $id; ?>" == 0){
					// set can't click #farmer-meta
					// $('#farmer-meta').addClass('disabled');
					// $('#farmer-approvals').addClass('disabled');
					$('#farmer-meta').hide();
					$('#farmer-approvals').hide();
				}

				// Store original GND options for filtering
				var originalGndOptions = $('#gnd-select option').clone();

				// District change event - load DSDs
				$('#district-select').change(function(){
					var district_id = $(this).val();
					var dsd_select = $('#dsd-select');
					var gnd_select = $('#gnd-select');
					
					// Clear DSD dropdown
					dsd_select.html('<option value="">-- Select DSD --</option>');
					
					// Reset GND dropdown to show default option only
					gnd_select.html('<option value="">-- Select GND --</option>');
					if(gnd_select.hasClass('select2-hidden-accessible')){
						gnd_select.select2('destroy');
						gnd_select.select2();
					}
					
					if(district_id){
						// AJAX call to get DSDs for selected district
						$.ajax({
							url: '<?php echo base_url("api/get_dsd_by_district"); ?>',
							type: 'POST',
							data: {district_id: district_id},
							dataType: 'json',
							success: function(response){
								if(response.status == 'success'){
									$.each(response.data, function(key, value){
										dsd_select.append('<option value="'+value.id+'">'+value.dsd+'</option>');
									});
								}
							},
							error: function(){
								console.log('Error loading DSDs');
							}
						});
					}
				});

				// DSD change event - filter GNDs
				$('#dsd-select').change(function(){
					var dsd_id = $(this).val();
					var gnd_select = $('#gnd-select');
					
					console.log('DSD changed to:', dsd_id);
					
					// Clear current options
					gnd_select.html('<option value="">-- Select GND --</option>');
					
					if(dsd_id){
						console.log('Filtering GNDs for dsd_id:', dsd_id);
						var matchCount = 0;
						// Add matching GND options
						originalGndOptions.each(function(){
							var optionDsdId = $(this).attr('data-dsd-id');
							console.log('Option:', $(this).text(), 'data-dsd-id:', optionDsdId);
							if($(this).val() == '' || optionDsdId == dsd_id){
								gnd_select.append($(this).clone());
								matchCount++;
							}
						});
						console.log('Found', matchCount, 'matching GNDs for dsd_id:', dsd_id);
					} else {
						// Show all GND options if no DSD selected
						gnd_select.html(originalGndOptions.clone());
					}
					
					// Refresh Select2 if it's initialized
					if(gnd_select.hasClass('select2-hidden-accessible')){
						gnd_select.select2('destroy');
						gnd_select.select2();
					}
				});

				// Initialize GND filtering on page load if DSD is already selected
				setTimeout(function(){
					var selected_dsd = $('#dsd-select').val();
					if(selected_dsd){
						$('#dsd-select').trigger('change');
					}
				}, 100);
			});

			// prevent button double click or raply click
			$('.save-btn').on('click', function() {
				$('.btn').hide();
			});

		</script>
	</body>
</html>
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
									<li class="breadcrumb-item active">Staff Meta</li>
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
										<a id="basic-info" href="<?php echo base_url("/user/add_edit/" . $id); ?>" class="nav-link">
											<i class="far fa-user"></i> <span>Basic Info</span>
										</a>
									</li>
									<li class="nav-item">
										<a id="staff-meta" href="<?php echo base_url("/user/staff_meta/" . $id); ?>" class="nav-link active">
											<i class="far fa-address-card"></i> <span>Staff Meta</span>
										</a>
									</li>
								</ul>
							</div>
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
						
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Staff meta</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/user/staff_meta/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

										<div class="row form-group">
                                    		<label for="field-label-<?php echo $inc; ?>"
                                           		class="col-sm-3 col-form-label input-label">Title</label>
                                    		<div class="col-sm-9">
                                        		<?php $field_name = "title"; ?>
                                        		<div class="col-md-10">
                                            		<select class="form-select<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                                    	id="field-label-<?php echo $inc++; ?>"
                                                    	name="<?php echo $field_name; ?>">
                                                	<?php if (!isset($record[$field_name])) { ?>
                                                    	<option value="">-- Select --</option>
                                                	<?php } ?>
                                                	<?php foreach ($title as $key => $val) { ?>
                                                    <option
                                                        <?php if (isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?>
                                                        value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                	<?php } ?>
                                            		</select>
                                            		<?php if ($validation->hasError($field_name)) { ?>
                                                		<div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            		<?php } ?>
                                        		</div>
                                    		</div>
                                		</div>

										<div class="row form-group">
                                    		<label for="field-label-<?php echo $inc; ?>"
                                        		class="col-sm-3 col-form-label input-label">Designation</label>
                                    		<div class="col-sm-9">
                                        		<?php $field_name = "designation"; ?>
                                        		<div class="col-md-10">
                                            		<select class="form-select<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                                    	id="field-label-<?php echo $inc++; ?>"
                                                    	name="<?php echo $field_name; ?>">
                                                	<?php if (!isset($record[$field_name])) { ?>
                                                    	<option value="">-- Select --</option>
                                                	<?php } ?>
                                                	<?php foreach ($designation as $key => $val) { ?>
                                                    <option
                                                        <?php if (isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?>
                                                        value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                	<?php } ?>
                                            		</select>
                                            		<?php if ($validation->hasError($field_name)) { ?>
                                                		<div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            		<?php } ?>
                                        		</div>
                                    		</div>
                                		</div>

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Permanant address no</label>
											<div class="col-sm-9">
                                                <?php $field_name = "permanant_address_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Permanant address no">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Permanant address street</label>
											<div class="col-sm-9">
                                                <?php $field_name = "permanant_address_street"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Permanant address street">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Permanant address city</label>
											<div class="col-sm-9">
                                                <?php $field_name = "permanant_address_city"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Permanant address city">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Temp address no</label>
											<div class="col-sm-9">
                                                <?php $field_name = "temp_address_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Temp address no">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Temp address street</label>
											<div class="col-sm-9">
                                                <?php $field_name = "temp_address_street"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Temp address street">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Temp address city</label>
											<div class="col-sm-9">
                                                <?php $field_name = "temp_address_city"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Temp address city">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <!-- <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Emergency contact</label>
											<div class="col-sm-9">
                                                <?php $field_name = "emergency_contact"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Emergency contact">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div> -->
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Assigned admin region</label>
											<div class="col-sm-9">
                                                <?php $field_name = "assigned_admin_region"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Assigned admin region">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Division</label>
											<div class="col-sm-9">
                                                <?php $field_name = "assigned_admin_division"; ?>
												<div class="col-md-10">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($assigned_admin_division as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Appointment date</label>
											<div class="col-sm-9">
                                                <?php $field_name = "appointment_date"; ?>
												<input type="text" class="datepicker form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="yyyy-mm-dd">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Employee No</label>
											<div class="col-sm-9">
                                                <?php $field_name = "employee_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="75">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Employer No</label>
											<div class="col-sm-9">
                                                <?php $field_name = "employer_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="A534">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Maritial status</label>
											<div class="col-sm-9">
                                                <?php $field_name = "maritial_status"; ?>
												<div class="col-md-10">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($maritial_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Recruitment type</label>
											<div class="col-sm-9">
                                                <?php $field_name = "recruitment_type"; ?>
												<div class="col-md-10">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($recruitment_type as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Phone office</label>
											<div class="col-sm-9">
                                                <?php $field_name = "phone_office"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Phone">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Phone extension</label>
											<div class="col-sm-9">
                                                <?php $field_name = "phone_extension"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Ext">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Heighest education qualification</label>
											<div class="col-sm-9">
                                                <?php $field_name = "heighest_education_qualification"; ?>
												<div class="col-md-10">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($heighest_education_qualification as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Professional membership</label>
											<div class="col-sm-9">
                                                <?php $field_name = "professional_membership"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Eg. Certified Management Accountants of Sri Lanka">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Salary scale</label>
											<div class="col-sm-9">
                                                <?php $field_name = "salary_scale"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="PS code of staff">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Basic salary</label>
											<div class="col-sm-9">
                                                <?php $field_name = "basic_salary"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Allowance</label>
											<div class="col-sm-9">
                                                <?php $field_name = "allowance"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Net salary</label>
											<div class="col-sm-9">
                                                <?php $field_name = "net_salary"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Employment status</label>
											<div class="col-sm-9">
                                                <?php $field_name = "employment_status"; ?>
												<div class="col-md-10">
												<select class="<?php echo $field_name; ?> form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($employment_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
											</div>
										</div>
                                        <div class="row form-group last_date_sapp_wrap">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Last Date in SAPP</label>
											<div class="col-sm-9">
                                                <?php $field_name = "last_date_sapp"; ?>
												<input type="text" class="datepicker1 form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
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
			$( ".datepicker" ).datepicker({ minDate: "-4Y", changeMonth: true, changeYear: true });
			$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".datepicker" ).val( "<?php if(isset($record['appointment_date'])){ echo $record['appointment_date']; } ?>" ), 200);

            $( ".datepicker1" ).datepicker({ minDate: "-4Y", changeMonth: true, changeYear: true });
			$( ".datepicker1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".datepicker1" ).val( "<?php if(isset($record['last_date_sapp'])){ echo $record['last_date_sapp']; } ?>" ), 200);

			$( ".last_date_sapp_wrap" ).hide();
			$( ".employment_status" ).change(function() {
				var employment_status = $( ".employment_status option:selected" ).val();
				if(employment_status==2)
				{
					$( ".last_date_sapp_wrap" ).show();
				}
				else
				{
					$( ".last_date_sapp_wrap" ).hide();
				}
			});

			QueryString = (new URL(location.href)).searchParams.get('mode');

        	if(QueryString){
        	    $('.btn').hide();
				$('.form-control').attr("disabled", "disabled");
				$('.form-control').removeAttr("placeholder");
				$('.form-select').attr("disabled", "disabled");
				$('.form-check-input').attr("disabled", "disabled");
				$('#basic-info').attr('href', '<?php echo base_url("/user/add_edit/" . $id); ?>?mode=view');
				$('#staff-meta').attr('href', '<?php echo base_url("/user/staff_meta/" . $id); ?>?mode=view');
			}
		});
		</script>
	</body>
</html>
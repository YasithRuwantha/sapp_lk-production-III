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
	<body onload="initialize();">
	
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
										<a href="<?php echo base_url("/user/farmer_project?user_type=2"); ?>">Beneficiaries</a>
									</li>
									<li class="breadcrumb-item active">Farmer</li>
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
										<a id="basic-info" href="<?php echo base_url("/user/add_edit/" . $id); ?>/?user_type=2" class="nav-link">
											<i class="far fa-user"></i> <span>Basic Info</span>
										</a>
									</li>
									<li class="nav-item">
										<a id="farmer-meta" href="<?php echo base_url("/user/farmer/" . $id); ?>" class="nav-link active">
											<i class="far fa-address-card"></i> <span>Farmer Meta</span>
										</a>
									</li>
									<li class="nav-item">
										<a id="farmer-approvals" href="<?php echo base_url("/user/approvals/" . $id); ?>" class="nav-link">
											<i class="far fa-address-card"></i> <span>Approvals</span>
										</a>
									</li>
									<!--
									<li class="nav-item">
										<a href="<?php echo base_url("/farmer/project_update/" . $id); ?>" class="nav-link">
											<i class="far fa-file"></i> <span>Project</span>
										</a>
									</li>
-->
								</ul>
							</div>
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
						
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Farmer</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/user/farmer/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Barrower type</label>
											<div class="col-sm-9">
                                                <?php $field_name = "barrower_type"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($barrower_type as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Is it woman headed family? </label>
											<div class="col-sm-9">
                                                <?php $field_name = "head_hh"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($head_hh as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Address no</label>
											<div class="col-sm-9">
                                                <?php $field_name = "address_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Address no">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Address street</label>
											<div class="col-sm-9">
                                                <?php $field_name = "address_street"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Address street">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Address city</label>
											<div class="col-sm-9">
                                                <?php $field_name = "address_city"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Address city">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Whatsapp no</label>
											<div class="col-sm-9">
                                                <?php $field_name = "whatsapp_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="Emergency contact">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Citizenship by</label>
											<div class="col-sm-9">
                                                <?php $field_name = "citizenship_by"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($citizenship_by as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Highest educational qualification</label>
											<div class="col-sm-9">
                                                <?php $field_name = "heighest_education_qualification"; ?>
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
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Age at the time of registration</label>
											<div class="col-sm-9">
                                                <?php $field_name = "age_while_register"; ?>
												<input type="number" step="1" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Availability of drinking water</label>
											<div class="col-sm-9">
                                                <?php $field_name = "availability_drinking_water"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $field_name; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($availability_drinking_water as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
									
                                        <div class="row form-group source-drinking-water-feild" style="display:none;">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id= "lbl-source-of-drinking-water">Source of drinking water</label>
											<div class="col-sm-9">
                                                <?php $field_name = "source_drinking_water"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($source_drinking_water as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="form-group row">
											<?php $field_name = "nature_agri_expense"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Nature of Expenditure for Agriculture base production</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="form-group row">
                                            <?php $field_name = "expense_agri"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Expenditure for Agriculture base production</label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
										<div class="form-group row">
											<?php $field_name = "nature_expense_other"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Nature of Expenditure for other (Household)</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="form-group row">
                                            <?php $field_name = "expense_other"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Expenditure for other (Household) in Rs.</label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Have you undergo any Training in Following</label>
											<div class="col-sm-9">
                                                <?php $field_name = "undergo_training"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										<div class="row form-group">
											<?php $field_name = "samurdhi_pds"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Are you member of Samurdi or any other PDS</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>		
										<div class="row form-group">
											<?php $field_name = "balance_diet"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Do you know the meaning of balance diet?</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	

										<div class="form-group row">
                                            <?php $field_name = "no_balance_diet"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-no-balance-diet">How many balance diets you have per day</label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="row form-group">
											<?php $field_name = "hunger_period"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Did your household experience a hunger period?</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	
										<div class="row form-group">
											<?php $field_name = "financial_decision"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Who is the taking financial decision in your family</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	
										<div class="row form-group">
											<?php $field_name = "before_barrow"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Before this Project did you borrow money</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-before-burrow">Source of credit</label>
											<div class="col-sm-9">
                                                <?php $field_name = "source_of_credit"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging"  id="field-label-<?php echo $field_name; ?>" name="<?php echo $field_name; ?>[]">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
													<?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="form-group row informal-field" style="display:none;">
                                            <?php $field_name = "informal_barrow"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-informal-barrow">How much money did you borrow (Informal)</label>
											<div class="col-sm-9">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="form-group row formal-field" style="display:none;">
                                            <?php $field_name = "formal_barrow"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-formal_barrow">How much money did you borrow (Formal)</label>
											<div class="col-sm-9">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
								
										<div class="row form-group informal-field" style="display:none;"  >
											<?php $field_name = "repaid_status_informal"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-rapid-status-informal">Status of repaid amount which was borrowed (Informal)</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	
            
										<div class="row form-group formal-field" style="display:none;">
											<?php $field_name = "repaid_status_formal"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-status-burrowed-formal">Status of repaid amount which was borrowed (formal)</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="form-group row formal-field" style="display:none;">
                                            <?php $field_name = "repaid_formal"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-repaid-formal">How much repaid (Formal)</label>
											<div class="col-sm-9">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
										<div class="form-group row informal-field" style="display:none;">
                                            <?php $field_name = "repaid_informal"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label" id="lbl-rapid-paid-informal">How much repaid (Informal)</label>
											<div class="col-sm-9">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
										<div class="row form-group">
											<?php $field_name = "registered_in"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Are you registered in any Organization?</label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "register_org"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Name of the Organization</label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>				
										

										<div class="row form-group">
											<?php $field_name = "civil_status"; ?>
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($$field_name as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "no_household_members"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "male_under_5"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>		
										<div class="form-group row">
                                            <?php $field_name = "female_under_5"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>		
										<div class="form-group row">
                                            <?php $field_name = "male_5_to_14"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "female_5_to_14"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "male_15_to_29"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "female_15_to_29"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "male_30_to_49"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "female_30_to_49"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "male_50_to_64"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "female_50_to_64"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
										<div class="form-group row">
                                            <?php $field_name = "male_over_65"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>	
										<div class="form-group row">
                                            <?php $field_name = "female_over_65"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-9">                                                
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>		



                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Availability of water crops</label>
											<div class="col-sm-9">
                                                <?php $field_name = "availability_water_crops"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $field_name; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($availability_water_crops as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group source-water-crops-field" style="display: none;">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Source of water crops</label>
											<div class="col-sm-9">
                                                <?php $field_name = "source_water_crops"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($source_water_crops as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Condition of house floor</label>
											<div class="col-sm-9">
                                                <?php $field_name = "cond_house_floor"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($cond_house_floor as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Consumer durables</label>
											<div class="col-sm-9">
                                                <?php $field_name = "consumer_durables"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($consumer_durables as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Avilability vehicles</label>
											<div class="col-sm-9">
                                                <?php $field_name = "avilability_vehicles"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($avilability_vehicles as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Sanitation</label>
											<div class="col-sm-9">
                                                <?php $field_name = "sanitation"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($sanitation as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Agri equipments</label>
											<div class="col-sm-9">
                                                <?php $field_name = "agri_equipments"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($agri_equipments as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Tools farmland</label>
											<div class="col-sm-9">
                                                <?php $field_name = "tools_farmland"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> tagging" multiple="multiple" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($tools_farmland as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && in_array($key,$record[$field_name])){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Main source income</label>
											<div class="col-sm-9">
                                                <?php $field_name = "main_source_income"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($main_source_income as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Main source income nature</label>
											<div class="col-sm-9">
                                                <?php $field_name = "main_source_income_nature"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($main_source_income_nature as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Average main agriculture income</label>
											<div class="col-sm-9">
                                                <?php $field_name = "avg_main_agriculture_income"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Average main agricultutre income nature</label>
											<div class="col-sm-9">
                                                <?php $field_name = "avg_main_agricultutre_income_nature"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($avg_main_agricultutre_income_nature as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Average harvest income</label>
											<div class="col-sm-9">
                                                <?php $field_name = "avg_harvest_income"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Other income</label>
											<div class="col-sm-9">
                                                <?php $field_name = "other_income"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Other income nature</label>
											<div class="col-sm-9">
                                                <?php $field_name = "other_income_nature"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($other_income_nature as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Other income discription</label>
											<div class="col-sm-9">
                                                <?php $field_name = "other_income_discription"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" placeholder="">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Availability electricity</label>
											<div class="col-sm-9">
                                                <?php $field_name = "availability_electricity"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $field_name; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($availability_electricity as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        <div class="row form-group electricity-from-feild" style="display: none;">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Electricity from</label>
											<div class="col-sm-9">
                                                <?php $field_name = "electricity_from"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($electricity_from as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Latitude</label>											
											<div class="col-sm-9">
                                                <?php $field_name = "lat"; ?>
												<input type="number" step="0.0001" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="txtLat<?php $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($geo_data[$field_name])){ echo number_format($geo_data[$field_name],4); } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-sm-3 col-form-label input-label">Longitude</label>											
											<div class="col-sm-9">
                                                <?php $field_name = "lng"; ?>
												<input type="number" step="0.0001" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="txtLng<?php $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($geo_data[$field_name])){ echo number_format($geo_data[$field_name],4); } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div id="map_canvas" class="form-group row" style="height:800px;"></div>

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
		
        <!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>  

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo config("App")->googleMapApiKey; ?>&v=weekly"
        async
        ></script>

        <script type="text/javascript">
			function initialize() {
				<?php if(isset($geo_data['lat']) && isset($geo_data['lng'])){ ?>
				// Creating map object
				var map = new google.maps.Map(document.getElementById('map_canvas'), {
					zoom: 8,
					center: new google.maps.LatLng(<?php echo $geo_data['lat']; ?>, <?php echo $geo_data['lng']; ?>),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});

				// creates a draggable marker to the given coords
				var vMarker = new google.maps.Marker({
					position: new google.maps.LatLng(<?php echo $geo_data['lat']; ?>, <?php echo $geo_data['lng']; ?>),
					draggable: true
				});
				<?php }else{ ?>
				// Creating map object
				var map = new google.maps.Map(document.getElementById('map_canvas'), {
					zoom: 8,
					center: new google.maps.LatLng(7.8742, 80.6511),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});

				// creates a draggable marker to the given coords
				var vMarker = new google.maps.Marker({
					position: new google.maps.LatLng(7.8742, 80.6511),
					draggable: true
				});
				<?php } ?>

				// adds a listener to the marker
				// gets the coords when drag event ends
				// then updates the input with the new coords
				google.maps.event.addListener(vMarker, 'dragend', function (evt) {
					$("#txtLat").val(evt.latLng.lat().toFixed(4));
					$("#txtLng").val(evt.latLng.lng().toFixed(4));

					map.panTo(evt.latLng);
				});

				// centers the map on markers coords
				map.setCenter(vMarker.position);

				// adds the marker on the map
				vMarker.setMap(map);
			}
		</script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

		<script>
		$( function() {
			$(".search-select").select2();

            <?php $field_name = "vcm_approval_date_time"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "rpc_approval_date_time"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			<?php $field_name = "liason_approval_date_time"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);
		});
		</script>

		<!-- If the Status is Rejected only, the Reason textbox is visible -->
        <script>
            $(document).ready(function () {
				QueryString = (new URL(location.href)).searchParams.get('mode');

                if(QueryString){
                    $('.btn').hide();
					$('.form-control').attr("disabled", "disabled");
					$('.form-control').removeAttr("placeholder");
					$('.form-select').attr("disabled", "disabled");
					$('.form-check-input').attr("disabled", "disabled");
                    $('#basic-info').attr('href', '<?php echo base_url("/user/add_edit/" . $id); ?>/?user_type=2&mode=view');
                    $('#farmer-meta').attr('href', '<?php echo base_url("/user/farmer/" . $id); ?>?mode=view');
                    $('#farmer-approvals').attr('href', '<?php echo base_url("/user/approvals/" . $id); ?>?mode=view');
                }

				<?php if (isset($this->data['record']['barrower_type'])){ ?>
              		$('.informal-field').show();
              		$('.formal-field').show();
					$('.source-drinking-water-feild').show();
					$('.source-water-crops-field').show();
					$('.electricity-from-feild').show();
				<?php } ?>
               
                $('#field-label-source_of_credit').change(function () {
                    // default hide the reason filed
                    $('.informal-field').hide();
                    $('.formal-field').hide();

                    if ($(this).val() === '1') {
						$('.formal-field').show();
                    } else if ($(this).val() === '2') {
						$('.informal-field').show();
                    }
                });

				$('#field-label-availability_drinking_water').change(function () {
                    // default hide the reason filed
                    $('.source-drinking-water-feild').hide();
                    
                    if ($(this).val() === '1') {
						$('.source-drinking-water-feild').show();
                    }
                });

				$('#field-label-availability_water_crops').change(function () {
                    // default hide the reason filed
                    $('.source-water-crops-field').hide();
                    
                    if ($(this).val() === '1') {
						$('.source-water-crops-field').show();
                    }
                });

				$('#field-label-availability_electricity').change(function () {
                    // default hide the reason filed
                    $('.electricity-from-feild').hide();
                    
                    if ($(this).val() === '1') {
						$('.electricity-from-feild').show();
                    }
                });

            });
        </script>

		
	</body>
</html>
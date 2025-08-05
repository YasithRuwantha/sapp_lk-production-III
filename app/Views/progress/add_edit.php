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
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Monthly Progress</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/progress/list_all/"); ?>">Monthly Progress</a></li>
									<li class="breadcrumb-item active">Progress Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Progress Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/progress/add_edit/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

                                        <div class="row form-group">
                                            <div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Reporting month</label>
                                                <?php $field_name = "reporting_month"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($reporting_month as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Promoter</label>
                                                <?php $field_name = "promoter_id"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($promoter_list as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['org_name']; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Reporting user</label>
                                                <?php $field_name = "reporting_user_id"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($user_list as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['fname']; ?> <?php echo $val['lname']; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Project ID</label>
                                                <?php $field_name = "project_id"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($project_list as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['project_name']; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
										<div class="row form-group">
											<div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Target male</label>
                                                <?php $field_name = "target_male"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Target female</label>
                                                <?php $field_name = "target_female"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Actual male</label>
                                                <?php $field_name = "actual_male"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-3 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Actual female</label>
                                                <?php $field_name = "actual_female"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
										<div class="row form-group">
											<div class="col-md-4 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Reg farmer</label>
                                                <?php $field_name = "reg_farmers"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-4 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Target farmer</label>
                                                <?php $field_name = "target_farmers"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
											<div class="col-md-4 mb-3">
                                                <label for="field-label-<?php echo $inc; ?>">Actual farmer</label>
                                                <?php $field_name = "actual_farmer"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
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
                QueryString = (new URL(location.href)).searchParams.get('mode');

        	    if(QueryString){
        	        $('.btn').hide();
        	        $('.form-control').attr("disabled", "disabled");
				    $('.form-control').removeAttr("placeholder");
				    $('.form-select').attr("disabled", "disabled");
        	    }
            } );
        </script>

	</body>
</html>
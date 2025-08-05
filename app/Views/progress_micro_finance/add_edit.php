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
								<h3 class="page-title">Progress Micro Finance</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/progress/list_all/"); ?>">Progress</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/progress_micro_finance/list_all/" . $entity_id); ?>">Progress Micro Finance</a></li>
									<li class="breadcrumb-item active">Progress Micro Finance Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Progress Farmer Contribution Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/progress_micro_finance/add_edit/" . $entity_id . "/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">                                        

										<div class="form-group row">
                                            <?php $field_name = "loans_applied_month"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_applied_lkr_month"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_reg_cbsl_month"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_reg_cbsl_lkr_month"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "no_loans_issued_month"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_issued_lkr_month"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_applied_cumilative"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_applied_lkr_cumilative"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_reg_cbsl_cumilative"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_applied_lkr_cumilative"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_issued_cumilative"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <?php $field_name = "loans_issued_lkr_cumilative"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <?php $field_name = "type_of_loan"; ?>
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-sm-10">                                                
												<select class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity-type" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($type_of_loan as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>  

										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>
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
            QueryString = (new URL(location.href)).searchParams.get('mode');

        	if(QueryString){
        	    $('.btn').hide();
        	    $('.form-control').attr("disabled", "disabled");
				$('.form-control').removeAttr("placeholder");
				$('.form-select').attr("disabled", "disabled");
        	}
            
			$(".search-select").select2();
		});
		</script>

	</body>
</html>

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
								<h3 class="page-title">Loan</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/loan/list_all/"); ?>">Loan</a></li>
									<li class="breadcrumb-item active">Loan Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Loan Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/loan/add_edit/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Type of loan scheme</label>
											<div class="col-sm-10">
                                                <?php $field_name = "type_of_loan_scheme"; ?>
												<select class="loan-type form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($type_of_loan_scheme as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        
                                        <div class="row form-group project-list">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Project</label>
											<div class="col-sm-10">
                                                <?php $field_name = "project_id"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> project" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
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

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan group name</label>
											<div class="col-sm-10">
                                                <?php $field_name = "loan_scheme_name"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Main purpose</label>
											<div class="col-sm-10">
                                                <?php $field_name = "main_purpose"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Sub purpose</label>
											<div class="col-sm-10">
                                                <?php $field_name = "sub_purpose"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>                                        

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Category</label>
											<div class="col-sm-10 category">
												<select class="form-select" id="field-label-<?php echo $inc++; ?>" name="category">
													<option value="">-- Select --</option>
												</select>
											</div>
										</div>                                        

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Status</label>
											<div class="col-sm-10">
                                                <?php $field_name = "loan_status"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($loan_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Remarks</label>
											<div class="col-sm-10">
                                                <?php $field_name = "loan_requirement"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
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

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

        <script>
		$( function() {
			<?php $field_name = "type_of_loan_scheme"; ?>

			<?php if(isset($record[$field_name]) && $record[$field_name]!=1){ ?>
				$(".project-list").hide();
			<?php } ?>
			// $('.loan-type').change(function(){
			// 	if ($(this).val() == "1"){
			// 		$(".project-list").show();
			// 	}else{
			// 		$(".project-list").hide();
			// 	}
			// });
			// get project list
			$('.loan-type').on('change', function() {
				var selectedValue = $(this).val();
				$.ajax({
					url: '<?php echo base_url("/loan/get_project/"); ?>/' + selectedValue,
					type: 'GET',
					success: function(response) {
						// console.log(response);
						// console.log(selectedValue);
						$('.project').html(response);
					},
					error: function(xhr, status, error) {
						// console.log(selectedValue);

						console.log(error);
					}
				});
			})


			<?php 
			$field_name = "project_id"; 
			if(isset($record[$field_name])){
			?>
			$.ajax({
				url: '<?php echo base_url("/loan/get_cat/".$id."/" . $record[$field_name]); ?>',
				type: 'GET',
				success: function(response) {
					$('.category').html(response);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
			<?php } ?>
			$('.project').on('change', function() {
				var selectedValue = $(this).val();
				$.ajax({
					url: '<?php echo base_url("/loan/get_cat/".$id); ?>/' + selectedValue,
					type: 'GET',
					success: function(response) {
						$('.category').html(response);
					},
					error: function(xhr, status, error) {
						console.log(error);
					}
				});
			});

		});
		</script>

		<script>
			$(document).ready(function () {
				QueryString = (new URL(location.href)).searchParams.get('mode');

        	if(QueryString){
        	    $('.btn').hide();
        	    $('.form-control').attr("disabled", "disabled");
				$('.form-control').removeAttr("placeholder");
				$('.form-select').attr("disabled", "disabled");
        	}
			});	
		</script>
	</body>
</html>
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
								<h3 class="page-title">Project Target</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/project/list_all/"); ?>">Project</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/project_target/list_all/" . $entity_id); ?>">Project Target</a></li>
									<li class="breadcrumb-item active">Contract Target Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Project Target Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/project_target/add_edit/" . $entity_id . "/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Category name</label>
											<div class="col-sm-10">
                                                <?php $field_name = "category_name"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Type</label>
											<div class="col-sm-10">
                                                <?php $field_name = "type"; ?>
												<select class="search-select target-type form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($type as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
													<?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
<!--
                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Qty</label>
											<div class="col-sm-10">
                                                <?php $field_name = "qty"; ?>
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
-->
                                        <div class="form-group row target_amount">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Approved loan amount</label>
											<div class="col-sm-10">
                                                <?php $field_name = "target_amount"; ?>
												<input type="number" step="0.01" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
												<div class="invalid-feedback">Approved amount is mandatory</div>
                                            </div>
										</div>  
												
										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Number of farmers</label>
											<div class="col-sm-10">
                                                <?php $field_name = "no_of_farmers"; ?>
												<input type="number" step="1" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>  
                                        
										<?php /** 
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Farmers</label>
											<div class="col-sm-10">
                                                <?php $field_name = "farmer_list"; ?>
												<select multiple size="5" class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>[]">
                                                    <?php foreach($farmer_list as $key=>$val){ ?>
                                                        <option class="entity" <?php if(in_array($val['id'],$selected_farmers)){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['fname']; ?> <?php echo $val['lname']; ?> (<?php echo $val['pin']; ?>)</option>
													<?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
										*/ ?>

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

        <script>
		$( function() {
            <?php $field_name = "extentend_completion_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-20Y", maxDate: "+20Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			$('.target_amount').on('blur', function() {
				var target_amount = $(this).val();

				if (target_amount === '') {
					$(this).addClass('is-invalid');
				} else {
					$(this).removeClass('is-invalid');
				}
			});

			var selectedValue = $('.target-type').val();		

			if (selectedValue === '1' || selectedValue === '3') {
				$('.target_amount').show();
			} else {
				$('.target_amount').hide();
			}

		});

		$(document).ready(function() {
  var target_amount = $('.target_amount').attr('value');
  console.log("test" + target_amount);

  if (target_amount === '') {
    $('.target_amount').addClass('is-invalid');
  } else {
    $('.target_amount').removeClass('is-invalid');
  }
});



        $(".search-select").select2();

		

		$('.target-type').change(function() {
			// Get the selected value
			var selectedValue = $(this).val();

			if (selectedValue === '1' || selectedValue === '3') {
				$('.target_amount').show();
				var target_amount = $('.target_amount').val();
				if (target_amount === '') {
					$(".target_amount").addClass('is-invalid');
				}
			} else {
				$('.target_amount').hide();
			}
		});
		</script>

<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</body>
</html>
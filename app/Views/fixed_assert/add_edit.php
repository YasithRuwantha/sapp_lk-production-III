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
								<h3 class="page-title">Fixed Asset</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a>
									</li>
									<li class="breadcrumb-item"><a href="<?php echo base_url("/fixed_assert/list_all/"); ?>">List Inventory</a></li>
									<li class="breadcrumb-item active">Asset Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Asset Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/fixed_assert/add_edit/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">                                        

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Name of the Asset</label>
											<div class="col-sm-10">
                                                <?php $field_name = "sapp_serial_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Type of Asset </label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "type_of_asset"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($type_of_asset as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Description model</label>
											<div class="col-sm-10">
                                                <?php $field_name = "description"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Asset code</label>
											<div class="col-sm-10">
                                                <?php $field_name = "asset_code"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>	

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Manufactor serial number</label>
											<div class="col-sm-10">
                                                <?php $field_name = "manufactor_serial_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Latest Working Status</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "latest_working_status"; ?>
                                                <select class="<?php echo $field_name; ?> form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($latest_working_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Remark</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "remarks"; ?>
                                                <input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Price</label>
											<div class="col-sm-10">
                                                <?php $field_name = "price"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Folio no</label>
											<div class="col-sm-10">
                                                <?php $field_name = "folio_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">GRN no</label>
											<div class="col-sm-10">
                                                <?php $field_name = "grn_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Supplier Name</label>
											<div class="col-sm-10">
                                                <?php $field_name = "supplier_name"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Voucher no</label>
											<div class="col-sm-10">
                                                <?php $field_name = "voucher_no"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Owner</label>
											<div class="col-sm-10">
                                                <?php $field_name = "user_id"; ?>
												<select class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
													<?php if(!isset($record[$field_name])){ ?>
														<option <?php if(isset($record[$field_name]) && 3 == $record[$field_name]){ ?>selected<?php } ?> value="3">SAPP</option>
													<?php } ?>
                                                    <?php foreach($user_list as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['fname'] . " " . $val['lname'] . " [" . $val['pin'] . "]"; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Ownership status</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "ownership_status"; ?>
                                                <select class="<?php echo $field_name; ?> form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($ownership_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Ownership transfer date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "ownership_transfer_date"; ?>
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> <?php echo $field_name; ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<?php $field_name = "disposal_date"; ?>
										<div class="row form-group form-group-<?php echo $field_name; ?>">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Disposal date</label>
											<div class="col-sm-10">                                                
												<input type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> <?php echo $field_name; ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<?php $field_name = "disposal_remark"; ?>
                                        <div class="row form-group form-group-<?php echo $field_name; ?>">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Disposal remark</label>
											<div class="col-sm-10">                                                
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

		<!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

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

			<?php $field_name = "disposal_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-90Y", maxDate: "+20Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			<?php $field_name = "ownership_transfer_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-90Y", maxDate: "+20Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			$('.ownership_status').change(function(){
				if ($(this).val() == "2"){
					$(".form-group-disposal_date").show();
					$(".form-group-disposal_remark").show();
				}else{
					$(".form-group-disposal_date").hide();
					$(".form-group-disposal_remark").hide();
				}
			});
			<?php if(!(isset($record['ownership_status']) && $record['ownership_status']==2)){ ?>
				$(".form-group-disposal_date").hide();
				$(".form-group-disposal_remark").hide();
			<?php } ?>
		});
		</script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

	</body>
</html>
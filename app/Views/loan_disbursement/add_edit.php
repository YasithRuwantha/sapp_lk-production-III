
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
								<h3 class="page-title">Loan Disbursement</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/loan/list_all/"); ?>">Loan</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/loan_disbursement/list_all/" . $loan_id); ?>">Loan Disbursement</a></li>
									<li class="breadcrumb-item active">Loan Disbursement Details</li>
								</ul>
							</div>
							<div class="col-auto">
                                    <a href="<?php echo base_url("/loan_disbursement/generate_template/" . $loan_id); ?>">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-download"></i> Template</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="<?php echo base_url("/loan_disbursement/resource_generate/" . $loan_id); ?>">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-download"></i> Resource</button>
                                        </div>
                                    </a>
                                </div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Loan Disbursement Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
										cano_get_alert();
                                    ?>
									<form method="post" action="<?php echo base_url("/loan_disbursement/add_edit/" . $loan_id . "/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan disbursement entity type</label>
											<div class="col-sm-10">
                                                <?php $field_name = "loan_disbursement_entity"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity-type" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($loan_disbursement_entity as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> 
														value="<?php echo $key; ?>">
														<?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row entity 2-entity form-group" >
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan disbursement entity</label>
											<div class="col-sm-10">
                                                <?php $field_name = "farmer_entity_id"; ?>
												<select class="2-entity-field search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name;?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php 
                                                   if(isset($farmer_list) && is_array($farmer_list)){
                                                    foreach($farmer_list as $key=>$val){ 
                                                        ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> 
														value="<?php echo $val['id']; ?>">
														<?php echo $val['fname']; ?> <?php echo $val['lname']; ?> (<?php echo $val['pin']; ?>)</option>
													<?php }} ?>
												</select>
												
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row entity 3-entity form-group" >
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan disbursement entity</label>
											<div class="col-sm-10">
                                                <?php $field_name = "promoter_entity_id"; ?>
												<select class="3-entity-field search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name;?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php 
                                                    if(isset($promoter_list) && is_array($promoter_list)){
                                                        foreach($promoter_list as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['org_name']; ?></option>
													<?php }} ?>
												</select>
												
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="row entity 1-entity form-group" >
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan disbursement entity</label>
											<div class="col-sm-10">
                                                <?php $field_name = "community_entity_id"; ?>
												<select class="1-entity-field search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name;?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>                                                    
                                                    <?php 
                                                    if(isset($community_list) && is_array($community_list)){
                                                        foreach($community_list as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['organization_name']; ?></option>
													<?php }} ?>
												</select>
												
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
                                        
                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">CBSL reg no</label>
											<div class="col-sm-10">
                                                <?php $field_name = "cbsl_reg_no"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Estimated Amount</label>
											<div class="col-sm-10">
                                                <?php $field_name = "cbsl_reg_amount"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Recommended Amount</label>
											<div class="col-sm-10">
                                                <?php $field_name = "required_loan_amount"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Disbursed Amount</label>
											<div class="col-sm-10">
                                                <?php $field_name = "actual_loan_amount"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan disbursement status</label>
											<div class="col-sm-10">
                                                <?php $field_name = "disbursement_status"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> disbursement_status" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($disbursement_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Loan disbursement date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "loan_disbursement_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Remarks</label>
											<div class="col-sm-10">
                                                <?php $field_name = "remarks"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="entity refinance form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Refinance date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "refinance_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="entity refinance form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Refinance Amount</label>
											<div class="col-sm-10">
                                                <?php $field_name = "refinance_amount"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>

									<br>
                                    <!--Bulk Upload Option-->
                                    <form action="<?php echo base_url('loan_disbursement/bulk_upload/' . $loan_id) ?>" method="POST"
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
            <?php $field_name = "loan_disbursement_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			<?php $field_name = "refinance_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			$('.entity').hide();

			<?php if(isset($record['loan_disbursement_entity'])){ ?>				
				$( ".<?php echo $record['loan_disbursement_entity']; ?>-entity" ).show();
			<?php } ?>

			<?php if(isset($record['disbursement_status']) && $record['disbursement_status']==4){ ?>				
				$( ".refinance" ).show();
			<?php } ?>

			$("select.disbursement_status").change(function(){
				var selectedState = $(this).children("option:selected").val();
				if(selectedState==4)
				{
					$( ".refinance" ).show();
				}	
				else{
					$( ".refinance" ).hide();
				}
			});

			$("select.entity-type").change(function(){
				$('.1-entity-field').val('');
				$('.2-entity-field').val('');
				$('.3-entity-field').val('');
			
				var selectedCountry = $(this).children("option:selected").val();
				$( ".entity" ).hide();
				$( "." + selectedCountry + "-entity" ).show();	
				// $( "." + selectedCountry + "-entity-field").attr("name", "entity_id");
			});

			

			$(".search-select").select2();

			QueryString = (new URL(location.href)).searchParams.get('mode');

        	if(QueryString){
        	    $('.btn').hide();
        	    $('.form-control').attr("disabled", "disabled");
				$('.form-control').removeAttr("placeholder");
				$('.form-select').attr("disabled", "disabled");
        	}
		});
		</script>

		<!-- <script>
			$(document).ready(function () {

                $('.entity-type').change(function () {
                    // default hide the filed
                    $('.1-entity').hide();
                    $('.2-entity').hide();
                    $('.3-entity').hide();

                    if ($(this).val() === '1') {
						$('.1-entity').show();
						// $( ".1-entity-field").attr("name", "entity_id");
                    } else if ($(this).val() === '2') {
						$('.2-entity').show();
						// $( ".2-entity-field").attr("name", "entity_id");
                    } else{
						$('.3-entity').show();
						// $( ".3-entity-field").attr("name", "entity_id");
					}
                });
            });
		</script> -->
	</body>
</html>
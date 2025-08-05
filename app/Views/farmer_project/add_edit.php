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
								<h3 class="page-title">Farmer Project</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/project/list_all/"); ?>">Project</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/farmer_project/list_all/" . $entity_id); ?>">Farmer Project</a></li>
									<li class="breadcrumb-item active">Farmer Project Details</li>
								</ul>
							</div>
							<!-- Bulk upload -->
							<div class="col-auto">
                                <a href="<?php echo base_url("/farmer_project/generate_template/". $entity_id); ?>">
                        	        <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-download"></i> Template</button>
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo base_url("/farmer_project/resource_generate/". $entity_id); ?>">
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
									<h5 class="card-title">Farmer Project Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/farmer_project/add_edit/" . $entity_id . "/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Search Farmer</label>
											<div class="col-sm-10">
												<select id="select2-dropdown" style="width: 100%;"></select>
											</div>
										</div>

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Farmer</label>
											<div class="col-sm-10">
                                            	<?php $field_name = "farmer_id"; ?>
												<!-- <input disabled type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>"> -->
												<input id="<?php echo $field_name; ?>" hidden type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" name="farmer_id" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                            	<?php $field_name2 = "farmer_name"; ?>
												<input id="farmer_name" readonly type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name2)){ ?> is-invalid<?php } ?>" name="farmer_name" value="<?php if(isset($record[$field_name2])){ echo $record[$field_name2]; } ?>">
												<?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
												
										</div>

										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Contribution</label>
											<div class="col-sm-10">
                                                <?php $field_name = "contribution"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Purpose</label>
											<div class="col-sm-10">
                                                <?php $field_name = "purpose"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
<!--
                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Project status</label>
											<div class="col-sm-10">
                                                <?php $field_name = "project_status"; ?>
												<select class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity-type" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($project_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>
												-->
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Category</label>
											<div class="col-sm-10">
                                                <?php $field_name = "eligible_status"; ?>
												<select class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity-type" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($eligible_status as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['category_name']; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">PFI ref No</label>
											<div class="col-sm-10">
                                                <?php $field_name = "pfi_ref_no"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
<!--
										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Obtained benifit</label>
											<div class="col-sm-10">
                                                <?php $field_name = "obtained_benifit"; ?>
												<select class="search-select form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity-type" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($obtained_benifit as $key=>$val){ ?>
                                                        <option <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>                                        
												-->

										<div class="form-group row">
											<div class="col-sm-12 is-invalid">                                                
                                                <div style="display:block" class="invalid-feedback alert-block"></div>
                                            </div>
										</div>

										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>

									<br>
                                    <!--Bulk Upload Option-->
                                    <form action="<?php echo base_url('farmer_project/bulk_upload/'. $entity_id) ?>" method="POST"
                                          enctype="multipart/form-data">
                                        <div class="form-group ">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Bulk
                                                upload</label>
                                            <input id="bulk_file" type="file" name="excel_file" accept=".xlsx, .xls" required><br>
											<!-- Alter before uploading, if there have existing value, it will overwrite -->
											<span class="info-text text-warning" hidden>NOTE: Uploading this file will overwrite any existing records in the system. 
												New data will be added without affecting the current data. Please review the file carefully before proceeding.</span>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Upload the Bulk</button>
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
            $(".search-select").select2();
		});


		$('.farmer-select').on('change', function() {
			var selectedValue = $(this).val();
			$('.alert-block').html('');
			$.ajax({
				url: "<?php echo base_url("/farmer_project/get_farmer_state/" . $entity_id); ?>/" + selectedValue,
				method: "GET",
				dataType: "json",
				success: function(data) {
					console.log(data);
					if (data && data.project_name) {
						$('.alert-block').html('The Farmer already registered on '+data.project_name+'. Please Confirm If you wish to register him on this project as well.');
						if(<?php echo $entity_id; ?>==data.project_id)
						{
							$('.alert-block').html('The Farmer Already Assigned to this project. ');
							$('.btn-primary').hide();
						}
						else
						{
							$('.btn-primary').show();
						}
					} else {
						$('.btn-primary').show();
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log("Error: " + errorThrown);
				}
			});
		});

		</script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

		<script>
			$(document).ready(function() {
				$('#select2-dropdown').select2({
					placeholder: 'Search for a record',
					minimumInputLength: 2, // Start searching after 2 characters are typed
					ajax: {
						url: '/api/farmer', // URL of your backend controller
						dataType: 'json',
						delay: 500, // Delay to reduce the number of requests sent to the server
						data: function (params) {
							// console.log(params);
							return {
								search: params.term, // Search term typed by the user
								page: params.page || 1 // Pagination page
							};
						},
						processResults: function (data, params) {
							params.page = params.page || 1;
							// console.log(data);
							return {
								results: data.results, // Results array from the server
								pagination: {
									more: data.pagination.more // Whether there are more results
								}
							};
						},
						cache: true
					},
					templateResult: formatResult, // Custom function to format the result
					templateSelection: formatSelection, // Custom function to format the selected value
				});

				$('#bulk_file').on('change', function() {
					$('.info-text').removeAttr('hidden');
				})
			});

			// Optional: Custom formatting for results
			function formatResult(repo) {
				if (repo.loading) {
					return repo.text;
				}
				var markup = `${repo.fname} ${repo.lname} (${repo.pin})`;
				return markup;
			}

			// Optional: Custom formatting for selected value
			function formatSelection(repo) {
				// console.log(repo);
				if (repo.pin != null) {
					$("#farmer_id").val(repo.id);
					$("#farmer_name").val(repo.fname + " " + repo.lname + " " + repo.pin);
					$('.invalid-feedback').hide();
				}
				return repo.name || repo.text;
			}

		</script>
		
	</body>
</html>
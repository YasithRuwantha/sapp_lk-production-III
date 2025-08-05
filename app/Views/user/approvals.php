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
									<li class="breadcrumb-item"><a href="<?php echo base_url("/user/list_all/"); ?>">Users</a>
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
										<a id="farmer-meta" href="<?php echo base_url("/user/farmer/" . $id); ?>" class="nav-link">
											<i class="far fa-address-card"></i> <span>Farmer Meta</span>
										</a>
									</li>
                                    <li class="nav-item">
										<a id="farmer-approvals" href="<?php echo base_url("/user/approvals/" . $id); ?>" class="nav-link active">
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
						<?php cano_get_alert(); ?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Approvals</h5>
								</div>
                                <div class="card-body">

                                    <form method="post" action="<?php echo base_url("/user/approvals/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
                                        <!--Changes Area by Ayesh-->
                                        <!-- Status -->
                                        <div class="row form-group">
                                            <label for="field-label-status"
                                                   class="col-form-label col-md-3">Status</label>
                                            <div class="col-sm-9">
                                                <?php $field_name = "status"; ?>
                                                <select class="form-select" id="field-label-status" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($approval[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
                                                    <?php foreach($status_approvals as $key=>$val){ ?>
                                                        <option class="entity" 
                                                            <?php if(isset($approval['status']) && $key == $approval['status']){ ?>selected<?php } ?> 
                                                            value="<?php echo $key; ?>"><?php echo $val; ?>
                                                        </option>
													<?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Date-->
                                        <div class="row form-group">
                                            <label for="field-label-date"
                                                   class="col-sm-3 col-form-label input-label">Date</label>
                                            <div class="col-sm-9">
                                                <?php $field_name = "approved_date"; ?>
                                                <input name="<?php echo $field_name; ?>" type="text" placeholder="" class="datepicker form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $field_name; ?>"
                                                       value="<?php if(isset($approval[$field_name])){ echo $approval[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- User Name -->
                                        <div class="row form-group">
                                            <label for="field-label-name"
                                                   class="col-sm-3 col-form-label input-label">Officer Name</label>
                                            <div class="col-sm-9">
                                                <?php $field_name = "user"; ?>
                                                <input name="<?php echo $field_name; ?>" type="text" placeholder="" class="form-control <?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>"
                                                       id="field-label-<?php echo $field_name; ?>" value="<?php if(isset($approval[$field_name])){ echo $approval[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- Designation -->
                                        <div class="row form-group">
                                            <label for="field-label-designation"
                                                   class="col-sm-3 col-form-label input-label">Designation</label>
                                            <div class="col-sm-9">
                                                <?php $field_name = "designation"; ?>
                                                <input name="<?php echo $field_name; ?>" type="text" placeholder="" class="form-control <?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $field_name; ?>"
                                                       value="<?php if(isset($approval[$field_name])){ echo $approval[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- Reason -->
                                        <div class="row form-group" id="reason-field" style="display:none;">
                                            <label for="field-label-reason"
                                                   class="col-sm-3 col-form-label input-label">Reason</label>
                                            <div class="col-sm-9">
                                                <?php $field_name = "reason"; ?>
                                                <input name="<?php echo $field_name; ?>" type="text" placeholder="Reason" class="form-control <?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $field_name; ?>""
                                                value="<?php if(isset($approval[$field_name])){ echo $approval[$field_name]; } ?>" >
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
		
        <!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>        

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo config("App")->googleMapApiKey; ?>&v=weekly"
        async
        ></script>

		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

		<script>
		$( function() {
			$(".search-select").select2();

            $( ".datepicker" ).datepicker({ minDate: "-10Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".datepicker" ).val( "<?php if(isset($approval['approved_date'])){ echo $approval['approved_date']; } ?>" ), 200);


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

                if ($('#field-label-status').val() === '3') {
                    $('#reason-field').show();
                }

                $('#field-label-status').change(function () {
                    // default hide the reason filed
                    $('#reason-field').hide();

                    if ($(this).val() === '2' || $(this).val() === '3') {
                        $('#field-label-approved_date').val('<?php echo date('Y-m-d');?>');
                        $('#field-label-user').val('<?php if (isset($user_record['fname'])) {
                            echo $user_record['fname']." ".$user_record['lname'];
                        } ?>');
                        $('#field-label-designation').val('<?php if (isset($designation['designation'])) {
                            echo $designation['designation'];
                        } ?>');

                        // show in rejected
                        if ($(this).val() === '3') {
                            $('#reason-field').show();
                        }

                    } else {
                        // set filed values to null
                        $('#field-label-date').val('');
                        $('#field-label-name').val('');
                        $('#field-label-designation').val('');
                    }

                });
            });
        </script>


    </body>
</html>
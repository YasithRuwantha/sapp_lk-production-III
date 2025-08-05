
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
								<h3 class="page-title">Procurement</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/procurement/list_all/"); ?>">Procurement</a></li>
									<li class="breadcrumb-item active">Procurement Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Procurement Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/procurement/add_edit/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Procurement Category</label>
											<div class="col-sm-10">
                                                <?php $field_name = "procurement_name"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Activity Title</label>
											<div class="col-sm-10">
                                                <?php $field_name = "title"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Estimated Amount (Rs.)</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "budget"; ?>
                                                <input type="number" step="0.01" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Procurement Method</label>
											<div class="col-sm-10">
                                                <?php $field_name = "type"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
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

										<div class="row form-group">
											<label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Project</label>
											<div class="col-sm-10">
                                                <?php $field_name = "project_id"; ?>
												<select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
													<?php if(!isset($record[$field_name])){ ?>
														<option value="">-- Select --</option>
													<?php } ?>
														<!-- <option <?php if(isset($record[$field_name]) && 1 == $record[$field_name]){ ?>selected<?php } ?> value="1">SAPP</option> -->
                                                    <?php foreach($project_id as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['project_name']; ?></option>
													<?php } ?>
												</select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
											</div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Activity Description</label>
											<div class="col-sm-10">
                                                <?php $field_name = "procurement_agency"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Contractual Agreement</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "contractual_agreement"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($contractual_agreement as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">NOC Status</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "no_objection"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($no_objection as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">NOC Obtained Date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "noc_obtained_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">NOC Remark</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "objection_remarks"; ?>
                                                <input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">AWPB Code</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "awpb_code"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($awpb_code as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Tags</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "tags"; ?>
                                                <input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Project Area</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "project_area"; ?>
                                                <input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Procurement Method 01</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "procurement_method_01"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($procurement_method_01 as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Procurement Method 02</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "procurement_method_02"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($procurement_method_02 as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
										
                                        <div class="row form-group">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Consulting Status</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "procurement_consent"; ?>
                                                <select class="form-select<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                                    <?php if(!isset($record[$field_name])){ ?>
                                                        <option value="">-- Select --</option>
                                                    <?php } ?>
                                                    <?php foreach($consulting_status as $key=>$val){ ?>
                                                        <option class="entity" <?php if(isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

										<div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Source of Financing</label>
											<div class="col-sm-10">
                                                <?php $field_name = "source_of_financing"; ?>
												<input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Bid Advertisement/ Invitation Date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "advertize_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Bid Opening Date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "opening_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">TEC Report Submission Date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "tec_report_submission_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Date of Contract Award</label>
											<div class="col-sm-10">
                                                <?php $field_name = "contract_award_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Date of Agreement Signing Date</label>
											<div class="col-sm-10">
                                                <?php $field_name = "agreement_signing_date"; ?>
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Supplier Name</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "supplier_name"; ?>
                                                <input type="text" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Actual Amount (Rs.)</label>
                                            <div class="col-sm-10">
                                                <?php $field_name = "actual_amount"; ?>
                                                <input type="number" step="0.01" placeholder="" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                    <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Documents</label>
											<div class="col-sm-10">
                                                <input type="file" id="edit_img" name="img[]" multiple="multiple"> <br>
                                                <?php
                                                if(isset($list_docs) && is_array($list_docs)){
                                                    foreach($list_docs as $val){
                                                        $s3path = s3_tmp_url(substr($val['relative_path'],1));
                                                ?>
                                                    <a href="<?php if(isset($val['relative_path'])){ echo $s3path; } ?>" target="_blank"><?php if(isset($val['file_name']) && strlen($val['file_name']) > 2){ echo $val['file_name']; }else{ echo "Open"; } ?></a><br>
                                                <?php }} ?>
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
            QueryString = (new URL(location.href)).searchParams.get('mode');

        	if(QueryString){
        	    $('.btn').hide();
        	    $('.form-control').attr("disabled", "disabled");
				$('.form-control').removeAttr("placeholder");
				$('.form-select').attr("disabled", "disabled");
        	}
            
            <?php $field_name = "opening_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "tec_report_submission_date"; ?>
            $( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
            $( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "advertize_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "noc_obtained_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "contract_award_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "agreement_signing_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);
		});
		</script>
	</body>
</html>
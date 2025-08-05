<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.css"); ?>">

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
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Doc Archive</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a>
									</li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/doc_archive/list_all/"); ?>">Doc Archive</a>
									</li>
									<li class="breadcrumb-item active">Doc Archive List</li>
								</ul>
							</div>
							<div class="col-auto">
								<?php if(is_auth("93")){ ?>
								<a href="<?php echo base_url("/doc_archive/add_edit/"); ?>" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								</a>
								<?php }?>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					<!-- Search Filter -->
                    <form method="get" action="<?php echo base_url("/doc_archive/list_all/"); ?>" enctype="multipart/form-data">
                    <?php
                        $inc=1;
                    ?>
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <?php $field_name = "uploaded_by"; ?>
                                    <label for="field-label-<?php echo $inc; ?>"><?php echo ucfirst(str_replace("_"," ","uploaded_by")); ?></label>
                                    <div class="col-sm-10">                                                
                                        <select class="search-select form-control" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                            <?php if(!isset($_GET[$field_name])){ ?>
                                                <option value="">-- Select --</option>
                                            <?php } ?>
                                            <?php foreach($uploaded_by as $key=>$val){ ?>
                                                <option class="entity" <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['fname']; ?> <?php echo $val['lname']; ?> (<?php echo $val['pin']; ?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <?php $field_name = "project_id"; ?>
                                    <label for="field-label-<?php echo $inc; ?>"><?php echo ucfirst(str_replace("_"," ","project")); ?></label>
                                    <div class="col-sm-10">                                                
                                        <select class="search-select form-control" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                            <?php if(!isset($_GET[$field_name])){ ?>
                                                <option value="">-- Select --</option>
                                            <?php } ?>
                                            <?php foreach($project_id as $key=>$val){ ?>
                                                <option class="entity" <?php if(isset($_GET[$field_name]) && $val['id'] == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $val['id']; ?>"><?php echo $val['project_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <?php $field_name = "category"; ?>
                                    <label for="field-label-<?php echo $inc; ?>"><?php echo ucfirst(str_replace("_"," ","project")); ?></label>
                                    <div class="col-sm-10">                                                
                                        <select class="search-select form-control" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>">
                                            <?php if(!isset($_GET[$field_name])){ ?>
                                                <option value="">-- Select --</option>
                                            <?php } ?>
                                            <?php foreach($category as $key=>$val){ ?>
                                                <option class="entity" <?php if(isset($_GET[$field_name]) && $key == $_GET[$field_name]){ ?>selected<?php } ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Description</label>
										<?php $field_name = "description"; ?>
										<input name="<?php echo $field_name; ?>" value="<?php if(isset($_GET[$field_name])){ echo $_GET[$field_name]; } ?>" type="text" class="<?php echo $field_name; ?> form-control">
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>
                    </form>
					<!-- /Search Filter -->
					
					<div class="row">
						<div class="col-sm-12">
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th><?php echo ucfirst(str_replace("_"," ","description")); ?></th>
                                                    <th><?php echo ucfirst(str_replace("_"," ","uploaded_by")); ?></th>
                                                    <th><?php echo ucfirst(str_replace("_"," ","project_Name")); ?></th>
                                                    <th><?php echo ucfirst(str_replace("_"," ","category")); ?></th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $val){
                                            ?>
												<tr>
                                                    <td><?php echo $val['description']; ?></td>
                                                    <td><?php echo $val['fname']; ?> <?php echo $val['lname']; ?></td>
                                                    <td><?php echo $val['project_name']; ?></td>
                                                    <td><?php echo $category[$val['category']]; ?></td>
                                                    <td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="btn btn-sm btn-white text-default" data-bs-toggle="dropdown" aria-expanded="false">Manage  <i class="fas fa-angle-down me-1"></i></a>
															
															<div class="dropdown-menu dropdown-menu-right">
															<?php if(is_auth("92")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/doc_archive/add_edit/" . $val['id']); ?>?mode=view">
																<i class="far fa-solid fa-eye me-2"></i>View
																</a>
																<?php } ?>
																<?php if(is_auth("94")){ ?>
																<a class="dropdown-item" href="<?php echo base_url("/doc_archive/add_edit/" . $val['id']); ?>">
																	<i class="far fa-edit me-2" ></i >Edit
																</a>
																<?php }?>
																<?php if(is_auth("95")){ ?>										
																<a class="dropdown-item" href="<?php echo base_url("/doc_archive/delete/" . $val['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
																	<i class="far fa-trash-alt me-2" ></i >Delete
																</a>
																<?php }?>
															</div>
														</div>
													</td>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											</tbody>
										</table>
									</div>
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
		
		<!-- Datatables JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/datatables/datatables.min.js"); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>

        <script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

		<!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

        <script>
		$( function() {
            <?php $field_name = "opening_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-1Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

            <?php $field_name = "advertize_date"; ?>
			$( ".<?php echo $field_name; ?>" ).datepicker({ minDate: "-1Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
			$( ".<?php echo $field_name; ?>" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			setTimeout($( ".<?php echo $field_name; ?>" ).val( "<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>" ), 200);

			$(".search-select").select2();
		});
		</script>
        
	</body>
</html>
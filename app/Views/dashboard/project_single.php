<!DOCTYPE html>
<!-- Janak - Changes made on 2022 Jan 05 -->
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		<!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">
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

					<!-- Search Filter -->
					<style>
					#filter_inputs {
						display: block !important;
					}
					</style>
                    <form method="get" action="<?php echo base_url("/dashboard/project/"); ?>">
					<?= $this->include('common/form_filter') ?>
                    </form>
					<!-- /Search Filter -->
<?php if(isset($_GET['p-id']) && strlen($_GET['p-id'])>0){ ?>

					<div class="row">
						
						<div class="col-md-6">
							<?php
								
							 	$entity_info = get_query_template_array(90);
							?>
							<div class="card">
								<div class="card-header">
									<div class="card-title">Project Details</div>
								</div>
								<div class="card-body">
									<?php 
										if(isset($entity_info[0]) && is_array($entity_info[0])){ 
											foreach($entity_info[0] as $key=>$val){ 
									?>
									<div class="form-group row" style="margin-bottom:3px;">
										<label class="col-form-label col-md-4"><?php echo $key; ?></label>
										<label class="col-form-label col-md-8">
											<?php 
												if (strpos($val, 'attom:') !== false)
												{
													$split_str = explode(":",$val);
													$config = json_decode(get_config($split_str[1]),TRUE);
													echo $config[$split_str[2]]; 
												}
												else
												{
													echo $val; 
												}											
											?>
										</label>
									</div>
									<?php }} ?>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<?php
								
							 	$promoter_info = get_query_template_array(65);
							?>
							<div class="card">
								<div class="card-header">
									<div class="card-title">Promoter</div>
								</div>
								<div class="card-body">
									<?php 
										if(isset($promoter_info[0]) && is_array($promoter_info[0])){ 
											foreach($promoter_info[0] as $key=>$val){ 
									?>
									<div class="form-group row" style="margin-bottom:3px;">
										<label class="col-form-label col-md-4"><?php echo $key; ?></label>
										<label class="col-form-label col-md-8">
											<?php 
												if (strpos($val, 'attom:') !== false)
												{
													$split_str = explode(":",$val);
													$config = json_decode(get_config($split_str[1]),TRUE);
													echo $config[$split_str[2]]; 
												}
												else
												{
													echo $val; 
												}											
											?>
										</label>
									</div>
									<?php }} ?>
								</div>
							</div>
						</div>

					</div>


					<div class="row">
						<div class="col-md-12">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Project Location</div>
								</div>
								<div class="card-body">
									<div id="map" class="rounded-map-project"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(54);
										$qdown = get_query_template_attom(55);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/4p_projects.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<!-- <div class="dash-title">4P Progress</div> -->
											<?php if($record['project_type'] == '5'){ ?>
												<div class="dash-title">IG Progress</div>
											<?php } elseif ($record['project_type'] == '6'){?>
												<div class="dash-title">Youth Progress</div>
											<?php } else {?>
												<div class="dash-title">4P Progress</div>
											<?php } ?>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?>/<?php echo number_format($qdown); ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(57);
										$qdown = get_query_template_attom(58);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/youth.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Credit Progress</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?>/<?php echo number_format($qdown); ?></p>
											</div>
										</div>
									</div>			
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(104);
										$qdown = get_query_template_attom(58);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/youth.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Grant Progress</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?>/<?php echo number_format($qdown); ?></p>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/ig.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">No of Trainings</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(59)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/overall.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">No of IS</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(60)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/ig.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Women Headed</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(93)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(91);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/youth.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Male</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(92);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/4p_projects.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Female</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/overall.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Youth</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(94)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>


					<!-- <h2>=========</h2>
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(54);
										$qdown = get_query_template_attom(55);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/4p_projects.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">4P Progress</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?>/<?php echo number_format($qdown); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(57);
										$qdown = get_query_template_attom(58);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/youth.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Credit Progress</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?>/<?php echo number_format($qdown); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/ig.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">No of Trainings</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(59)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/overall.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">No of IS</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(60)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>		



					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(92);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/4p_projects.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Female</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<?php
										$qup = get_query_template_attom(91);
									?>
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/youth.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Male</div>
											<div class="dash-counts">
												<p><?php echo number_format($qup); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/ig.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Women Headed</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(93)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/overall.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Youth</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(94)); ?></p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>	
					<h2>=========</h2> -->
					


					<div class="row">
						<div class="col-md-6">
							<div class="card highlight-column">
								<div class="card-header">
									<div class="card-title">Status of Grant Disbursment</div>
								</div>
								<div class="card-body">
									<div id="project_status"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Status of Loan Disbursment</div>
								</div>
								<div class="card-body">
									<div
										id="type_of_training"
										style="min-height: 128.7px"
									></div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Project Target</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(62); 
                                                    if(isset($list_all[0]) && is_array($list_all[0])){
                                                        foreach($list_all[0] as $key=>$val){
                                                    ?>
                                                    <th><?php echo $key; ?></th>
                                                    <?php }} ?>
												</tr>
											</thead>
											<tbody>
											<?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <?php 
                                                    if(isset($val) && is_array($val)){
                                                        foreach($val as $key1=>$val1){
                                                    ?>
                                                    <td><?php echo print_db_data($val1); ?></td>
                                                    <?php }} ?>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											<tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Training Programs</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(95); 
                                                    if(isset($list_all[0]) && is_array($list_all[0])){
                                                        foreach($list_all[0] as $key=>$val){
                                                    ?>
                                                    <th><?php echo $key; ?></th>
                                                    <?php }} ?>
												</tr>
											</thead>
											<tbody>
											<?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <?php 
                                                    if(isset($val) && is_array($val)){
                                                        foreach($val as $key1=>$val1){
                                                    ?>
                                                    <td><?php echo print_db_data($val1); ?></td>
                                                    <?php }} ?>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											<tbody>
										</table>
										<a href="<?php echo base_url("/reports/training_programmes?project-project_name=" . $record['project_name']); ?>&dummy" target="_blank" class="btn btn-primary me-1">
											More Info
										</a>
									</div>
								</div>
							</div>
						</div>						
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Off Farm Activities</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(96); 
                                                    if(isset($list_all[0]) && is_array($list_all[0])){
                                                        foreach($list_all[0] as $key=>$val){
                                                    ?>
                                                    <th><?php echo $key; ?></th>
                                                    <?php }} ?>
												</tr>
											</thead>
											<tbody>
											<?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <?php 
                                                    if(isset($val) && is_array($val)){
                                                        foreach($val as $key1=>$val1){
                                                    ?>
                                                    <td><?php echo print_db_data($val1); ?></td>
                                                    <?php }} ?>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											<tbody>
										</table>
										<a href="<?php echo base_url("/reports/off_farm_development?project-project_name=" . $record['project_name']); ?>&dummy" target="_blank" class="btn btn-primary me-1">
											More Info
										</a>
									</div>
								</div>
							</div>
						</div>						
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Loan Disbursment</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(97); 
                                                    if(isset($list_all[0]) && is_array($list_all[0])){
                                                        foreach($list_all[0] as $key=>$val){
                                                    ?>
                                                    <th><?php echo $key; ?></th>
                                                    <?php }} ?>
												</tr>
											</thead>
											<tbody>
											<?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <?php 
                                                    if(isset($val) && is_array($val)){
                                                        foreach($val as $key1=>$val1){
                                                    ?>
                                                    <td><?php echo print_db_data($val1); ?></td>
                                                    <?php }} ?>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											<tbody>
										</table>
										<a href="<?php echo base_url("/reports/loan_disbursement?project-project_name=" . $record['project_name']); ?>&dummy" target="_blank" class="btn btn-primary me-1">
											More Info
										</a>
									</div>
								</div>
							</div>
						</div>						
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Grant Disbursment</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(98); 
                                                    if(isset($list_all[0]) && is_array($list_all[0])){
                                                        foreach($list_all[0] as $key=>$val){
                                                    ?>
                                                    <th><?php echo $key; ?></th>
                                                    <?php }} ?>
												</tr>
											</thead>
											<tbody>
											<?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <?php 
                                                    if(isset($val) && is_array($val)){
                                                        foreach($val as $key1=>$val1){
                                                    ?>
                                                    <td><?php echo print_db_data($val1); ?></td>
                                                    <?php }} ?>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											<tbody>
										</table>
										<a href="<?php echo base_url("/reports/grant?project-project_name=" . $record['project_name']); ?>&dummy" target="_blank" class="btn btn-primary me-1">
											More Info
										</a>
									</div>
								</div>
							</div>
						</div>						
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">IS Activities</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(99); 
                                                    if(isset($list_all[0]) && is_array($list_all[0])){
                                                        foreach($list_all[0] as $key=>$val){
                                                    ?>
                                                    <th><?php echo $key; ?></th>
                                                    <?php }} ?>
												</tr>
											</thead>
											<tbody>
											<?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <?php 
                                                    if(isset($val) && is_array($val)){
                                                        foreach($val as $key1=>$val1){
                                                    ?>
                                                    <td><?php echo print_db_data($val1); ?></td>
                                                    <?php }} ?>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											<tbody>
										</table>
										<a href="<?php echo base_url("/reports/is?project-project_name=" . $record['project_name']); ?>&dummy" target="_blank" class="btn btn-primary me-1">
											More Info
										</a>
									</div>
								</div>
							</div>
						</div>						
					</div>


				<?php } ?>


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

		<!-- Chart JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/apexchart/apexcharts.js"); ?>"></script>
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/apexchart/chart-data.js"); ?>"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>
        <!-- Chart JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/morris/raphael-min.js"); ?>"></script>
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/morris/morris.min.js"); ?>"></script>

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo config("App")->googleMapApiKey; ?>&callback=initMap&v=weekly"
        async
        ></script>

        <script>

			<?= $this->include('dashboard/default/bar_4p_progress') ?>
			<?= $this->include('dashboard/default/rural_finance_progress') ?>


			<?= $this->include('dashboard/project_single/grand_disbursement_pie') ?>
			<?= $this->include('dashboard/project_single/loan_disbursement_pie') ?>
			<?= $this->include('dashboard/project_single/promoter_pie') ?>
			<?= $this->include('dashboard/project_single/project_target_pie') ?>

			<?= $this->include('dashboard/project_single/benifited_through') ?>

			<?= $this->include('dashboard/default/is_vs_projects') ?>
			<?= $this->include('dashboard/default/status_of_grant_disbursment') ?>
			<?= $this->include('dashboard/default/status_of_loan_disbursment') ?>

			

    	</script>
		<?php if(isset($_GET['p-id'])){ ?>
		<script type="text/javascript">
			<?php 
			$project_location = get_query_template_array(66); 
			?>
        var markers = [
            {
            "title": 'Central',
            "lat": '7.874217',
            "lng": '80.651129',
            "description": 'This is the central location'
            }<?php
			if(isset($project_location) && is_array($project_location)){
				foreach($project_location as $val){
			?>,
            {
                "title": '<?php echo $val['title']; ?>',
                "lat": '<?php echo $val['lat']; ?>',
                "lng": '<?php echo $val['lng']; ?>',
                "description": '<?php echo $val['label']; ?> <br><br> <a href="<?php echo base_url("/project/add_edit/" . $_GET['p-id']); ?>" target="_blank">view project</a>'
            }<?php
				}
			}
			?>
        ];


        window.onload = function () {
            LoadMap();
        }
        function LoadMap() {
            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    
            //Create and open InfoWindow.
            var infoWindow = new google.maps.InfoWindow();
    
            for (var i = 1; i < markers.length; i++) {
                var data = markers[i];
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: data.title
                });
    
                //Attach click event to the marker.
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow.setContent("<h1 style = 'font-size:14px;'>" + data.title + "</h1><div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }

        }		
    </script>
	<?php } ?>

	<!-- Select 2 -->
	<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

<script>
$( function() {
	$(".search-select").select2();
});
</script>
	</body>
</html>

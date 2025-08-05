
<!DOCTYPE html>
<!-- Janak - Changes made on 2022 Jan 05 -->
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
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
					<?php cano_get_alert(); ?>
					<div class="row">

						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/4p_projects.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">4P Project Beneficiaries</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(17)); ?>/<?php echo number_format(get_query_template_attom(18)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(19); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(19); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(19); ?>%</span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/youth.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Youth</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(20)); ?>/<?php echo number_format(get_query_template_attom(21)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(22); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(22); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(22); ?>%</span>
									</p>
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
											<div class="dash-title">IG</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(23)); ?>/<?php echo number_format(get_query_template_attom(24)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(25); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(25); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(25); ?>%</span>
									</p>
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
											<div class="dash-title">Maize Resilience</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(119)); ?>/<?php echo number_format(get_query_template_attom(120)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(121); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(121); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(121); ?>%</span>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/farmer-4.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Youth - Male</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(111)); ?>/<?php echo number_format(get_query_template_attom(20)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(112); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(112); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(112); ?>%</span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/farmer-3.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">Youth - Female</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(113)); ?>/<?php echo number_format(get_query_template_attom(20)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(114); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(114); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(114); ?>%</span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/farmer-4.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">IG - Male</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(115)); ?>/<?php echo number_format(get_query_template_attom(23)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(116); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(116); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(116); ?>%</span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<img src="<?php echo base_url("/public/theme/html-files/template/assets/img/farmer-3.png"); ?>" class="dashboard_icon" width="64" height="64"/>
										</span>
										<div class="dash-count">
											<div class="dash-title">IG - Female</div>
											<div class="dash-counts">
												<p><?php echo number_format(get_query_template_attom(117)); ?>/<?php echo number_format(get_query_template_attom(23)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: <?php echo get_query_template_attom(118); ?>%"
											aria-valuenow="<?php echo get_query_template_attom(118); ?>"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1" ><i class="fas me-1"></i><?php echo get_query_template_attom(118); ?>%</span>
									</p>
								</div>
							</div>
						</div>
					</div>
					

					<div class="row" >
						<div class="col-md-4">
							<div class="card highlight-column">
								<div class="card-header">
									<div class="card-title">4P Project Status</div>
								</div>
								<div class="card-body" >
									<div 
										id="project_status"
									></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card ">
								<div class="card-header">
									<div class="card-title">Status of Grant Disbursement</div>
								</div>
								<div class="card-body" >
									<div
										id="status_of_grant_disbursment"
										style="min-height: 128.7px"
									></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Status of Loan Disbursement</div>
								</div>
								<div class="card-body">
									<div
										id="status_of_loan_disbursment"
										style="min-height: 128.7px"
									></div>
								</div>
							</div>
						</div>
					</div>
					<!--  -->

					

					<div class="row">
						<div class="col-md-6">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Location of Intervention</div>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<input type="checkbox" checked value="projects">- Projects
										<input type="checkbox" value="farmers">- Farmers
										<input type="checkbox" value="off_farms">- Off Farms
										<input type="checkbox" value="matching_grants">- Matching Grants
									</div>
									<div id="map" class="rounded-map"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Benificiary Engagement</div>
								</div>
								<div class="card-body">
									<div id="bar_4p_progress"></div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<!-- <div class="card-title">Rural Finance - Planned Vs Progress</div> -->
									<div class="card-title">Loan vs Grant Disbursement (Last 12 Months) </div>
								</div>
								<div class="card-body">
									<div id="rural_finance_progress"></div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="card highlight-column">
								<div class="card-header">
									<div class="card-title">Status of off Farm</div>
								</div>
								<div class="card-body">
									<div id="off_farm_status"></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Status of IS Programmes</div>
								</div>
								<div class="card-body">
									<div
										id="is_program_status"
										style="min-height: 128.7px"
									></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Status of Start up Fund</div>
								</div>
								<div class="card-body">
									<div
										id="startup_fund_status"
										style="min-height: 128.7px"
									></div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Contracts Expiring in Next 45 Days</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(34); 
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
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Recent Procurement</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												<?php 
													$list_all = get_query_template_array(35); 
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

			<?= $this->include('dashboard/default/startup_fund_status') ?>
			<?= $this->include('dashboard/default/is_program_status') ?>
			<?= $this->include('dashboard/default/off_farm_status') ?>

			<?= $this->include('dashboard/default/bar_4p_progress') ?>
			<?= $this->include('dashboard/default/rural_finance_progress') ?>


			<?= $this->include('dashboard/default/project_status') ?>
			<?= $this->include('dashboard/default/type_of_training') ?>
			<?= $this->include('dashboard/default/organized_by') ?>
			<?= $this->include('dashboard/default/benifited_through') ?>

			<?= $this->include('dashboard/default/is_vs_projects') ?>
			<?= $this->include('dashboard/default/status_of_grant_disbursment') ?>
			<?= $this->include('dashboard/default/status_of_loan_disbursment') ?>

    	</script>
		<script type="text/javascript">
			<?php 
			$project_status = json_decode(get_config(19),TRUE);
			$project_location = get_query_template_array(29); 
			?>
			var iconBase = 'https://maps.google.com/mapfiles/ms/icons/';
        var projectLocations = [
            <?php
			if(isset($project_location) && is_array($project_location)){
				foreach($project_location as $val){
			?>
            {
				
				"type": 'projects',
				"display_name":'Project',
                "title": '<?php echo $val['project_name']; ?>',
                "lat": '<?php echo $val['lat']; ?>',
                "lng": '<?php echo $val['lng']; ?>',
                "description": '<?php echo $val['fname'] . " " . $val['lname']; ?> | <?php echo $project_status[$val['project_status']]; ?> <br><br> <a href="<?php echo base_url("/dashboard/project?p-id=" . $val['id']); ?>" target="_blank">view project</a>',
                "status": '<?php echo $project_status[$val['project_status']]; ?>',
            },<?php
				}
			}
			?>
        ];

		<?php 
			$farmer_location = get_query_template_array(106); 
			?>
        var farmerLocations = [
            <?php
			if(isset($farmer_location) && is_array($farmer_location)){
				foreach($farmer_location as $val){
			?>
            {
				"type": 'farmers',
				"display_name":'Farmer',
                "title": '<?php echo $val['fname'] . " " . $val['lname']; ?>',
                "lat": '<?php echo $val['lat']; ?>',
                "lng": '<?php echo $val['lng']; ?>',
                "description": 'Project: <?php echo $val['project_name']?>'
            },<?php
				}
			}
			?>
        ];

		<?php 
			// $off_farm_location = get_query_template_array(43); 
			$off_farm_location = get_query_template_array(107); 
			?>
        var offFarmLocations = [
            <?php
			if(isset($off_farm_location) && is_array($off_farm_location)){
				foreach($off_farm_location as $val){
			?>
            {
				"type": 'off_farms',
				"display_name":'Off Farm Development',
                "title": '<?php echo $val['off_farm_dev_name']; ?>',
                "lat": '<?php echo $val['lat']; ?>',
                "lng": '<?php echo $val['lng']; ?>',
                "description": 'Estimated cost: <?php echo $val['estimated_cost'] . '<br><a target="_blank" href="' . base_url("/off_farm_development/view/" . $val['off_farm_id'].'?mode=view') . '">Detail</a>'; ?>'
            },<?php
				}
			}
			?>
        ];

		<?php 
			$matching_grant_location = get_query_template_array(108); 
			?>
        var matchingGrantLocations = [
            <?php
			if(isset($matching_grant_location) && is_array($matching_grant_location)){
				foreach($matching_grant_location as $val){
			?>
            {
				"type": 'matching_grants',
				"display_name": 'Matching Grant',
                "title": '<?php echo $val['matching_grant_dev_name']?>',
                "lat": '<?php echo $val['lat']; ?>',
                "lng": '<?php echo $val['lng']; ?>',
                "description": 'Estimated cost: <?php echo $val['estimated_cost'] . '<br><a target="_blank" href="' . base_url("/matching_grant_development/view/" . $val['matching_grant_id']. '?mode=view') . '">Detail</a>'; ?>'
            },<?php
				}
			}
			?>
        ];

		var allLocations = farmerLocations.concat(projectLocations, matchingGrantLocations, offFarmLocations);

		window.onload = function () {
            initialize();
        }

  		function initialize() {
			var infoWindow = new google.maps.InfoWindow();

  		  	var mapOptions = {
  		    	zoom: 8,
  		    	center: new google.maps.LatLng(7.8731, 80.7718)
  		  	};
  		    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  		    var markerGroups=new google.maps.MVCObject();
	  
  		    $(':checkbox').each(function(i,n){
    
  		       markerGroups.set(this.value,map);
  		       for(var i=0;i<allLocations.length;++i){
					var locationData = allLocations[i];
  		          	marker=new google.maps.Marker({
  		              	position:new google.maps.LatLng(allLocations[i].lat, allLocations[i].lng),
  		              	title: allLocations[i].display_name + ' - ' + allLocations[i].title,
						animation: google.maps.Animation.DROP,
						icon: getPoint(allLocations[i].type),
						
				});

  		        marker.bindTo('map', markerGroups, allLocations[i].type);

				  //Attach click event to the marker.
				(function (marker, locationData) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow.setContent("<h1 style = 'font-size:14px;'>" + locationData.title + "</h1><div style = 'width:200px;min-height:40px'>" + locationData.description + "</div>");
                        infoWindow.open(map, marker);
                	});
                })(marker, locationData);

  		       }
		   
  		    }).on('click init',function(){markerGroups.set(this.value,(this.checked)?map:null)}).trigger('init');	  
  		}

			// theme colors
				// "#A44A3F",
				// "#FFB703",
				// "#023047",
				// "#09814A",
				// "#20A39E",
				// "#885A89",
				// "#667761",

 		google.maps.event.addDomListener(window, 'load', initialize);  

		//  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
		// <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M16 144a144 144 0 1 1 288 0A144 144 0 1 1 16 144zM160 80c8.8 0 16-7.2 16-16s-7.2-16-16-16c-53 0-96 43-96 96c0 8.8 7.2 16 16 16s16-7.2 16-16c0-35.3 28.7-64 64-64zM128 480V317.1c10.4 1.9 21.1 2.9 32 2.9s21.6-1 32-2.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32z"/></svg>
		// <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
		// <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M32 32C32 14.3 46.3 0 64 0H320c17.7 0 32 14.3 32 32s-14.3 32-32 32H290.5l11.4 148.2c36.7 19.9 65.7 53.2 79.5 94.7l1 3c3.3 9.8 1.6 20.5-4.4 28.8s-15.7 13.3-26 13.3H32c-10.3 0-19.9-4.9-26-13.3s-7.7-19.1-4.4-28.8l1-3c13.8-41.5 42.8-74.8 79.5-94.7L93.5 64H64C46.3 64 32 49.7 32 32zM160 384h64v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384z"/></svg>
		
		function getPoint(pointType){
			// pointer properties
			if(pointType == "projects"){
				var pinSVGFilled = "M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z";
				var pinColor = "#A44A3F";
				var size = 0.05;
				var PointAnchor = new google.maps.Point(120,400);

			} else if(pointType == "farmers"){
				var pinSVGFilled = "M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z";
				var pinColor = "#885A89";
				var size = 0.04;
				var PointAnchor = new google.maps.Point(150,450);

			} else if(pointType == "off_farms"){
				var pinSVGFilled = "M16 144a144 144 0 1 1 288 0A144 144 0 1 1 16 144zM160 80c8.8 0 16-7.2 16-16s-7.2-16-16-16c-53 0-96 43-96 96c0 8.8 7.2 16 16 16s16-7.2 16-16c0-35.3 28.7-64 64-64zM128 480V317.1c10.4 1.9 21.1 2.9 32 2.9s21.6-1 32-2.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32z";
				var pinColor = "#023047";
				var size = 0.05;
				var PointAnchor = new google.maps.Point(150,470);

			} else if(pointType == "matching_grants"){
				var pinSVGFilled = "M32 32C32 14.3 46.3 0 64 0H320c17.7 0 32 14.3 32 32s-14.3 32-32 32H290.5l11.4 148.2c36.7 19.9 65.7 53.2 79.5 94.7l1 3c3.3 9.8 1.6 20.5-4.4 28.8s-15.7 13.3-26 13.3H32c-10.3 0-19.9-4.9-26-13.3s-7.7-19.1-4.4-28.8l1-3c13.8-41.5 42.8-74.8 79.5-94.7L93.5 64H64C46.3 64 32 49.7 32 32zM160 384h64v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384z";
				var pinColor = "#3d11ee";
				var size = 0.04;
				var PointAnchor = new google.maps.Point(150,470);

			}

    		var markerImage = { 
    		    path: pinSVGFilled,
    		    anchor: PointAnchor,
    		    fillOpacity: 1,
    		    fillColor: pinColor,
    		    strokeWeight: 1,
    		    strokeColor: '#FFFFFF',
    		    scale: size,
    		};
			return markerImage;

		}

		

        // function LoadMap() {
        //     var mapOptions = {
        //         center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
        //         zoom: 8,
        //         mapTypeId: google.maps.MapTypeId.ROADMAP
        //     };
        //     var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		// 	//var map1 = new google.maps.Map(document.getElementById("off_farm_map"), mapOptions);
    
        //     //Create and open InfoWindow.
        //     var infoWindow = new google.maps.InfoWindow();
    
        //     for (var i = 1; i < markers1.length; i++) {
        //         var data = markers1[i];
        //         var myLatlng = new google.maps.LatLng(data.lat, data.lng);

		// 		console.log(data);
		// 		if(data.status == "1"){
		// 			// Ongoing
		// 			iconType = iconBase + 'red-dot.png';
		// 		} else if (data.status == "2") {
		// 			// Planned 
		// 			iconType = iconBase + 'green-dot.png';
		// 		} else if (data.status == "3"){
		// 			// Completed 
		// 			iconType  = iconBase + 'yellow-dot.png'
		// 		} else if (data.status == "4"){
		// 			// Suspended 
		// 			iconType = iconBase + 'blue-dot.png'
		// 		} else {
		// 			iconType = iconBase + 'red-dot.png';
		// 		}

        //         var marker = new google.maps.Marker({
        //             position: myLatlng,
        //             map: map,
        //             title: data.title,
		// 			icon: iconType
		// 			// icon: iconBase + 'library_maps.png',
		// 			// fillColor: "#FFFFFF"
		// 			// icon: iconBase + 'red-dot.png'
        //         });
    
        //         //Attach click event to the marker.
        //         (function (marker, data) {
        //             google.maps.event.addListener(marker, "click", function (e) {
        //                 infoWindow.setContent("<h1 style = 'font-size:14px;'>" + data.title + "</h1><div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
        //                 infoWindow.open(map, marker);
        //             });
        //         })(marker, data);
        //     }

			
        // }		
    </script>
	</body>
</html>

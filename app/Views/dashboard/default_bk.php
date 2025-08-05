
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
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1" style="color:#ffb800;">
											Rs.
										</span>
										<div class="dash-count">
											<div class="dash-title">Total Loan</div>
											<div class="dash-counts">
												<p>1,742</p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-5"
											role="progressbar"
											style="width: 75%"
											aria-valuenow="75"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-danger me-1"
											><i class="fas fa-arrow-down me-1"></i
											>1.15%</span
										>
										since last week
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<i class="fas fa-users"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Registered Benificiaries</div>
											<div class="dash-counts">
                                                <?php 
                                                    $direction = get_query_template_attom(4); 
                                                    if(strlen($direction)==0){ $direction=0; }
                                                ?>
												<p><?php echo number_format(get_query_template_attom(3)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-6"
											role="progressbar"
											style="width: <?php echo $direction; ?>%"
											aria-valuenow="75"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-<?php if($direction>0){ ?>success<?php }elseif($direction==0){ ?>muted<?php }else{ ?>danger<?php } ?> me-1"
											><i class="fas fa-arrow-<?php if($direction>0){ ?>up<?php }elseif($direction==0){ ?><?php }else{ ?>down<?php } ?> me-1"></i
											><?php echo $direction; ?>%</span
										>
										since last week
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-3">
											<i class="fas fa-file-alt"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Active 4P Projects</div>
											<div class="dash-counts">
                                                <?php 
                                                    $direction = get_query_template_attom(2); 
                                                    if(strlen($direction)==0){ $direction=0; }
                                                ?>
												<p><?php echo number_format(get_query_template_attom(1)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-7"
											role="progressbar"
											style="width: <?php echo $direction; ?>%"
											aria-valuenow="75"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
                                        
										<span class="text-<?php if($direction>0){ ?>success<?php }elseif($direction==0){ ?>muted<?php }else{ ?>danger<?php } ?> me-1"
											><i class="fas fa-arrow-<?php if($direction>0){ ?>up<?php }elseif($direction==0){ ?><?php }else{ ?>down<?php } ?> me-1"></i
											><?php echo $direction; ?>%</span
										>
										since last week
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-4">
											<i class="far fa-file"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Promoters</div>
											<div class="dash-counts">
                                                <?php 
                                                    $direction = get_query_template_attom(6); 
                                                    if(strlen($direction)==0){ $direction=0; }
                                                ?>
												<p><?php echo number_format(get_query_template_attom(5)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-8"
											role="progressbar"
											style="width: 45%"
											aria-valuenow="75"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										<span class="text-<?php if($direction>0){ ?>success<?php }elseif($direction==0){ ?>muted<?php }else{ ?>danger<?php } ?> me-1"
											><i class="fas fa-arrow-<?php if($direction>0){ ?>up<?php }elseif($direction==0){ ?><?php }else{ ?>down<?php } ?> me-1"></i
											><?php echo $direction; ?>%</span
										>
										since last week
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
                        <div class="col-md-6">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Project Location</div>
								</div>
								<div class="card-body">
									<div id="map" style="height:760px;"></div>
								</div>
							</div>
						</div>
                        <div class="col-md-6">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Youth Composition</div>
								</div>
								<div class="card-body">
									<div id="youth_composition"></div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<div class="card-title">Farmer Distribution in District Basis</div>
								</div>
								<div class="card-body">
									<div id="farmer_distribution"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">	
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-3">
											<i class="fas fa-file-alt"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">No of Trainings Conducted</div>
											<div class="dash-counts">
												<?php 
													$direction = get_query_template_attom(2); 
													if(strlen($direction)==0){ $direction=0; }
												?>
												<p><?php echo number_format(get_query_template_attom(1)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-7"
											role="progressbar"
											style="width: <?php echo $direction; ?>%"
											aria-valuenow="75"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										
										<span class="text-<?php if($direction>0){ ?>success<?php }elseif($direction==0){ ?>muted<?php }else{ ?>danger<?php } ?> me-1"
											><i class="fas fa-arrow-<?php if($direction>0){ ?>up<?php }elseif($direction==0){ ?><?php }else{ ?>down<?php } ?> me-1"></i
											><?php echo $direction; ?>%</span
										>
										since last week
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-3">
											<i class="fas fa-file-alt"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">No of Trainings Planned</div>
											<div class="dash-counts">
												<?php 
													$direction = get_query_template_attom(2); 
													if(strlen($direction)==0){ $direction=0; }
												?>
												<p><?php echo number_format(get_query_template_attom(1)); ?></p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div
											class="progress-bar bg-7"
											role="progressbar"
											style="width: <?php echo $direction; ?>%"
											aria-valuenow="75"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<p class="text-muted mt-3 mb-0">
										
										<span class="text-<?php if($direction>0){ ?>success<?php }elseif($direction==0){ ?>muted<?php }else{ ?>danger<?php } ?> me-1"
											><i class="fas fa-arrow-<?php if($direction>0){ ?>up<?php }elseif($direction==0){ ?><?php }else{ ?>down<?php } ?> me-1"></i
											><?php echo $direction; ?>%</span
										>
										since last week
									</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Type of Trainings</div>
								</div>
								<div class="card-body">
									<div id="type_of_training"></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Organized By</div>
								</div>
								<div class="card-body">
									<div id="organized_by"></div>
								</div>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Gender Composition of Farmers</div>
								</div>
								<div class="card-body">
									<div id="farmer_gender"></div>
								</div>
							</div>
						</div>	
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">IS Progremmers</div>
								</div>
								<div class="card-body">
									<div id="is_progremers"></div>
								</div>
							</div>
						</div>					
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Status of Benificiaries</div>
								</div>
								<div class="card-body">
									<div id="status_of_benifit"></div>
								</div>
							</div>
						</div>	
						<div class="col-md-6">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Off Farmdevelopment</div>
								</div>
								<div class="card-body">
									<div id="off_farm_map" style="height:760px;"></div>
								</div>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Loan progress in Last 6 Month</div>
								</div>
								<div class="card-body">
									<div id="loan_progress"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Contracts Expiring in Next 30 Months</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
													<th>Customer</th>
													<th>Amount</th>
													<th>Due Date</th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php for($i=0;$i<10;$i++){ ?>
												<tr>
													<td>Barbara Moore</td>
													<td>$118</td>
													<td>23 Nov 2020</td>
													<td>
														<span class="badge bg-success-light">Paid</span>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#"
																class="action-icon dropdown-toggle"
																data-bs-toggle="dropdown"
																aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div
																class="dropdown-menu dropdown-menu-right"
															>
																<a
																	class="dropdown-item"
																	href="edit-invoice.html"
																	><i
																		class="far fa-edit me-2"
																	></i
																	>Edit</a
																>
																<a
																	class="dropdown-item"
																	href="view-invoice.html"
																	><i
																		class="far fa-eye me-2"
																	></i
																	>View</a
																>
																<a
																	class="dropdown-item"
																	href="javascript:void(0);"
																	><i
																		class="far fa-trash-alt me-2"
																	></i
																	>Delete</a
																>
																<a
																	class="dropdown-item"
																	href="javascript:void(0);"
																	><i
																		class="far fa-check-circle me-2"
																	></i
																	>Mark as sent</a
																>
																<a
																	class="dropdown-item"
																	href="javascript:void(0);"
																	><i
																		class="far fa-paper-plane me-2"
																	></i
																	>Send Invoice</a
																>
																<a
																	class="dropdown-item"
																	href="javascript:void(0);"
																	><i
																		class="far fa-copy me-2"
																	></i
																	>Clone Invoice</a
																>
															</div>
														</div>
													</td>
												</tr>
												<?php } ?>
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
			$(function () {
				//Pie Chart
				var pieCtx = document.getElementById("youth_composition"),
					pieConfig = {
						colors: ["#023047", "#FFB703", "#A8B7AB"],
						series: [45, 50, 5],
						chart: {
							fontFamily: "Poppins, sans-serif",
							height: 350,
							type: "donut",
						},
						labels: ["Men", "Women", "Gender Not Specified"],
						legend: { show: true },
						responsive: [
							{
								breakpoint: 480,
								options: {
									chart: {
										width: 200,
									},
									legend: {
										position: "bottom",
									},
								},
							},
						],
					};
				var pieChart = new ApexCharts(pieCtx, pieConfig);
				pieChart.render();

				var pieCtx = document.getElementById("type_of_training"),
					pieConfig = {
						colors: [
							"#A44A3F",
							"#FFB703",
							"#023047",
							"#09814A",
							"#20A39E",
							"#885A89",
							"#667761",
						],
						series: [55, 40, 20, 10, 55, 40, 20],
						chart: {
							fontFamily: "Poppins, sans-serif",
							height: 300,
							type: "donut",
						},
						labels: [
							"Technical",
							"Financial",
							"Bookkeeping",
							"Gender",
							"Nutrition",
							"Environment",
							"Business Proposal Making",
						],
						legend: { show: false },
						responsive: [
							{
								breakpoint: 480,
								options: {
									chart: {
										width: 200,
									},
									legend: {
										position: "bottom",
									},
								},
							},
						],
					};
				var pieChart = new ApexCharts(pieCtx, pieConfig);
				pieChart.render();

				var pieCtx = document.getElementById("organized_by"),
					pieConfig = {
						colors: ["#A44A3F", "#FFB703", "#023047", "#09814A"],
						series: [55, 40, 20, 10],
						chart: {
							fontFamily: "Poppins, sans-serif",
							height: 300,
							type: "donut",
						},
						labels: [
							"Promoter",
							"Project Management Unit",
							"PFI",
							"Farmer Organization",
						],
						legend: { show: false },
						responsive: [
							{
								breakpoint: 480,
								options: {
									chart: {
										width: 200,
									},
									legend: {
										position: "bottom",
									},
								},
							},
						],
					};
				var pieChart = new ApexCharts(pieCtx, pieConfig);
				pieChart.render();

				var pieCtx = document.getElementById("farmer_gender"),
					pieConfig = {
						colors: ["#023047", "#FFB703", "#A8B7AB"],
						series: [40, 40, 20],
						chart: {
							fontFamily: "Poppins, sans-serif",
							height: 300,
							type: "donut",
						},
						labels: ["Men", "Women", "Gender Not Specified"],
						legend: { show: true },
						responsive: [
							{
								breakpoint: 480,
								options: {
									chart: {
										width: 200,
									},
									legend: {
										position: "bottom",
									},
								},
							},
						],
					};
				var pieChart = new ApexCharts(pieCtx, pieConfig);
				pieChart.render();

				var pieCtx = document.getElementById("is_progremers"),
					pieConfig = {
						colors: ["#A44A3F", "#FFB703", "#023047"],
						series: [55, 40, 20],
						chart: {
							fontFamily: "Poppins, sans-serif",
							height: 300,
							type: "donut",
						},
						labels: ["Paid", "Unpaid", "Overdue"],
						legend: { show: false },
						responsive: [
							{
								breakpoint: 480,
								options: {
									chart: {
										width: 200,
									},
									legend: {
										position: "bottom",
									},
								},
							},
						],
					};
				var pieChart = new ApexCharts(pieCtx, pieConfig);
				pieChart.render();

				var pieCtx = document.getElementById("status_of_benifit"),
					pieConfig = {
						colors: [
							"#A44A3F",
							"#FFB703",
							"#023047",
							"#09814A",
							"#20A39E",
						],
						series: [55, 40, 20, 10, 5],
						chart: {
							fontFamily: "Poppins, sans-serif",
							height: 300,
							type: "donut",
						},
						labels: [
							"Pending Bank Response",
							"Farmer Rejected",
							"Loan Disbursed",
							"Loan Repaid",
							"Registered",
						],
						legend: { show: false },
						responsive: [
							{
								breakpoint: 480,
								options: {
									chart: {
										width: 200,
									},
									legend: {
										position: "bottom",
									},
								},
							},
						],
					};
				var pieChart = new ApexCharts(pieCtx, pieConfig);
				pieChart.render();

				// Column chart district distribution
				var columnCtx = document.getElementById("farmer_distribution"),
					columnConfig = {
						colors: ["#023047"],
						series: [
							{
								name: "District",
								type: "column",
								data: [70, 150, 80, 180, 150, 175, 201, 60, 200],
							},
						],
						chart: {
							type: "bar",
							fontFamily: "Poppins, sans-serif",
							height: 250,
							toolbar: {
								show: false,
							},
						},
						plotOptions: {
							bar: {
								borderRadius: 10,
								horizontal: false,
								// columnWidth: "60%",
								dataLabels: {
									position: "top", // top, center, bottom
								},
							},
						},
						dataLabels: {
							enabled: true,
						},
						stroke: {
							show: true,
							width: 2,
							colors: ["transparent"],
						},
						xaxis: {
							categories: [
								"Colombo",
								"Gambaha",
								"Ratnapura",
								"Monarakala",
								"Jaffna",
								"Anuradhapura",
								"Polannaruwe",
								"Vavunia",
								"Nuwerelya",
								"Kandy",
							],
						},
						yaxis: {
							title: {
								text: "Number of farmers",
							},
						},
						fill: {
							opacity: 1,
						},
						tooltip: {
							y: {
								formatter: function (val) {
									return val + " Farmers";
								},
							},
						},
					};
				var columnChart = new ApexCharts(columnCtx, columnConfig);
				columnChart.render();

				var columnCtx = document.getElementById("loan_progress"),
					columnConfig = {
						colors: ["#A44A3F"],
						series: [
							{
								name: "District",
								type: "column",
								data: [70, 150, 80, 180, 150, 175, 201, 60, 200],
							},
						],
						chart: {
							type: "bar",
							fontFamily: "Poppins, sans-serif",
							height: 250,
							toolbar: {
								show: false,
							},
						},
						plotOptions: {
							bar: {
								borderRadius: 10,
								horizontal: false,
								columnWidth: "60%",
								endingShape: "flat",
								dataLabels: {
									position: "top", // top, center, bottom
								},
							},
						},
						dataLabels: {
							enabled: true,
						},
						stroke: {
							show: true,
							width: 2,
							colors: ["transparent"],
						},
						xaxis: {
							categories: [
								"Colombo",
								"Gambaha",
								"Ratnapura",
								"Monarakala",
								"Jaffna",
								"Anuradhapura",
								"Polannaruwe",
								"Vavunia",
								"Nuwerelya",
								"Kandy",
							],
						},
						yaxis: {
							title: {
								text: "Number of farmers",
							},
						},
						fill: {
							opacity: 1,
						},
						tooltip: {
							y: {
								formatter: function (val) {
									return val + " Farmers";
								},
							},
						},
					};
				var columnChart = new ApexCharts(columnCtx, columnConfig);
				columnChart.render();
			});
		</script>
		<script type="text/javascript">
        var markers = [
            {
            "title": 'Central',
            "lat": '7.874217',
            "lng": '80.651129',
            "description": 'This is the central location'
            },
            {
                "title": 'Aksa Beach',
                "lat": '6.91548',
                "lng": '79.84818',
                "description": 'Aksa Beach is a popular beach and a vacation spot in Aksa village at Malad, Mumbai.'
            },
            {
                "title": 'Juhu Beach',
                "lat": '6.92538',
                "lng": '80.14828',
                "description": 'Juhu Beach is one of favourite tourist attractions situated in Mumbai.'
            },
            {
                "title": 'Girgaum Beach',
                "lat": '7.23528',
                "lng": '80.34838',
                "description": 'Girgaum Beach commonly known as just Chaupati is one of the most famous public beaches in Mumbai.'
            },
            {
                "title": 'Jijamata Udyan',
                "lat": '6.94518',
                "lng": '80.54848',
                "description": 'Jijamata Udyan is situated near Byculla station is famous as Mumbai (Bombay) Zoo.'
            },
            {
                "title": 'Sanjay Gandhi National Park',
                "lat": '6.96508',
                "lng": '80.74868',
                "description": 'Sanjay Gandhi National Park is a large protected area in the northern part of Mumbai city.'
            }
        ];

		var markers1 = [
            {
            "title": 'Central',
            "lat": '7.874217',
            "lng": '80.651129',
            "description": 'This is the central location'
            },
            {
                "title": 'Aksa Beach',
                "lat": '6.91548',
                "lng": '79.84818',
                "description": 'Aksa Beach is a popular beach and a vacation spot in Aksa village at Malad, Mumbai.'
            },
            {
                "title": 'Juhu Beach',
                "lat": '6.92538',
                "lng": '80.14828',
                "description": 'Juhu Beach is one of favourite tourist attractions situated in Mumbai.'
            },
            {
                "title": 'Girgaum Beach',
                "lat": '7.23528',
                "lng": '80.34838',
                "description": 'Girgaum Beach commonly known as just Chaupati is one of the most famous public beaches in Mumbai.'
            },
            {
                "title": 'Jijamata Udyan',
                "lat": '6.94518',
                "lng": '80.54848',
                "description": 'Jijamata Udyan is situated near Byculla station is famous as Mumbai (Bombay) Zoo.'
            },
            {
                "title": 'Sanjay Gandhi National Park',
                "lat": '6.96508',
                "lng": '80.74868',
                "description": 'Sanjay Gandhi National Park is a large protected area in the northern part of Mumbai city.'
            }
        ];

        window.onload = function () {
            LoadMap();
        }
        function LoadMap() {
            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 8,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
			var map1 = new google.maps.Map(document.getElementById("off_farm_map"), mapOptions);
    
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
                        infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }

			var infoWindow1 = new google.maps.InfoWindow();
    
            for (var i = 1; i < markers1.length; i++) {
                var data = markers1[i];
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map1,
                    title: data.title
                });
    
                //Attach click event to the marker.
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow1.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                        infoWindow1.open(map, marker);
                    });
                })(marker, data);
            }
        }		
    </script>
	</body>
</html>

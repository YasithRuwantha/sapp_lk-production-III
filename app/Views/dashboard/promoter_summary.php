
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
                        
                        <div class="col-md-6">
                            <div class="col-xl-12 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon bg-2">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <div class="dash-count">
                                                <div class="dash-title">Number of Promotors</div>
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
                            <div class="col-xl-12 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon bg-3">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <div class="dash-count">
                                                <div class="dash-title">Promoters without Projects</div>
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
                        </div>

                        <div class="col-md-6">	
							<div class="card">
									<div class="card-header">
										<div class="card-title">Promoter business type</div>
									</div>
									<div class="card-body">
										<div id="pie_promoter_business"></div>
									</div>
								</div>
						</div>					
					</div>

					<div class="row">
                        <div class="col-md-12">	
							<div class="card">
									<div class="card-header">
										<div class="card-title">Promoter farmers</div>
									</div>
									<div class="card-body">
										<div id="bar_promoter"></div>
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
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/apexchart/apexcharts.min.js"); ?>"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>
        <!-- Chart JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/morris/raphael-min.js"); ?>"></script>
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/morris/morris.min.js"); ?>"></script>
        <script>  
        $( function() {
            // Column chart district distribution
            var columnCtx = document.getElementById("bar_promoter"),
            columnConfig = {
                colors: ['#7638ff', '#fda600'],
                series: [
                    {
                    name: "District",
                    type: "column",
                    data: [70, 150, 80, 180, 150, 175, 201, 60, 200]
                    }
                ],
                chart: {
                    type: 'bar',
                    fontFamily: 'Poppins, sans-serif',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '60%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Colombo', 'Gambaha', 'Ratnapura', 'Monarakala', 'Jaffna', 'Anuradhapura', 'Polannaruwe', 'Vavunia', 'Nuwerelya', 'Kandy'],
                },
                yaxis: {
                    title: {
                        text: 'Number of farmers'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " Farmers"
                        }
                    }
                }
            };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();

            //Pie Chart
            var pieCtx = document.getElementById("pie_promoter_business"),
            pieConfig = {
                colors: ['#7638ff', '#ff737b', '#fda600', '#1ec1b0'],
                series: [55, 40, 20, 10],
                chart: {
                    fontFamily: 'Poppins, sans-serif',
                    height: 260,
                    type: 'donut',
                },
                labels: ['Paid', 'Unpaid', 'Overdue', 'Draft'],
                legend: {show: false},
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            var pieChart = new ApexCharts(pieCtx, pieConfig);
            pieChart.render();
            

		});
		</script>
	</body>
</html>

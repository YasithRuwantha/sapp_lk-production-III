
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
                                                <i class="fas fa-briefcase"></i>
                                            </span>
                                            <div class="dash-count">
                                                <div class="dash-title">Number of Active Projects</div>
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
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                            <div class="dash-count">
                                                <div class="dash-title">Total Loan (LKR)</div>
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
										<div class="card-title">Project district</div>
									</div>
									<div class="card-body">
										<div id="bar_project_district"></div>
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
										<div id="map" style="height:800px;"></div>
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

        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo config("App")->googleMapApiKey; ?>&callback=initMap&v=weekly"
        async
        ></script>

        <script>  
        $( function() {
            // Column chart district distribution
            var columnCtx = document.getElementById("bar_project_district"),
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
                    height: 250,
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
        }
    </script>
	</body>
</html>

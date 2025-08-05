<template>
    <!-- Main Wrapper -->
		<div class="main-wrapper">
            <layout-header></layout-header>
			<layout-sidebar></layout-sidebar>
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
		 
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Vector Maps</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
									<li class="breadcrumb-item active">Vector Maps</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- World Map -->
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">World Map</h5>
								</div>
								<div class="card-body">
									<div id="world_map" style="height: 400px"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- /World Map -->
			   
					<div class="row">
						<div class="col-lg-6">
							<!-- USA Map -->
							<div class="card bg-white">
								<div class="card-header">
									<h5 class="card-title">USA Map</h5>
								</div>
								<div class="card-body">
									<div id="usa" style="height: 400px"></div>
								</div>
							</div>
							<!-- /USA Map -->
						</div>
						<div class="col-lg-6">
							<!-- UK Map -->
							<div class="card bg-white">
								<div class="card-header">
									<h5 class="card-title">UK Map</h5>
								</div>
								<div class="card-body">
									<div id="uk" style="height: 400px"></div>
								</div>
							</div>
							<!-- /UK Map -->
						</div>
					</div>
			   
					<div class="row">
						<div class="col-lg-6">
							<!-- India Map -->
							<div class="card bg-white">
								<div class="card-header">
									<h5 class="card-title">India Map</h5>
								</div>
								<div class="card-body">
									<div id="india" style="height: 400px"></div>
								</div>
							</div>
							<!-- /India Map -->
						</div>
						<div class="col-lg-6">
							<!-- Russia Map -->
							<div class="card bg-white">
								<div class="card-header">
									<h5 class="card-title">Russia Map</h5>
								</div>
								<div class="card-body">
									<div id="russia" style="height: 400px"></div>
								</div>
							</div>
							<!-- /Russia Map -->
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
			
		</div>
		<!-- /Main Wrapper -->
</template>

<script>
export default {
    mounted() {
        // vector maps
        $('#world_map').vectorMap({
            map: 'world_mill',
            scaleColors : ['#03a9f4', '#03a9f4'],
            normalizeFunction : 'polynomial',
            hoverOpacity : 0.7,
            hoverColor : false,
            regionStyle : {
                initial : {
                    fill : '#7638ff'
                }
            },
            backgroundColor : 'transparent'
        });
        
        $('#usa').vectorMap({
            map: 'us_aea',
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: '#7638ff'
                }
            }
        });
        $('#india').vectorMap({
            map : 'in_mill',
            backgroundColor : 'transparent',
            regionStyle : {
                initial : {
                    fill : '#7638ff'
                }
            }
        });
        $('#uk').vectorMap({map: 'uk_countries_mill',backgroundColor: 'transparent',
                regionStyle: {
                    initial: {
                    fill: '#7638ff'
                }
        }});
        $('#russia').vectorMap({
            map: 'ru_mill',
            backgroundColor: 'transparent',
                regionStyle: {
                    initial: {
                    fill: '#7638ff'
                }
        }});
    }
}
</script>
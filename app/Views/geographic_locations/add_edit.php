<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('common/html_head') ?>

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">

        <!-- Datepicker CSS -->
        <link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/css/bootstrap-datetimepicker.min.css"); ?>">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
		/>
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
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">GEO Location</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/" . $parent_menue[$table] . "/list_all/"); ?>"><?php echo ucfirst(str_replace("_"," ",$parent_menue[$table])); ?></a>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("/geographic_locations/list_all/" . $table . "/" . $entity_id . "/"); ?>">GEO Location</a></li>
									<li class="breadcrumb-item active">GEO Location Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
                        <div class="col-lg-8 col-md-6">
							<div class="card">
								<!-- Map here -->
								<div class="card-body">
									<div
										id="map_canvas"
										class="form-group row individual-map" 
									></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">GEO Location Details</h5>
								</div>
								<div class="card-body">
                                    <?php
                                        $inc=1;
                                    ?>
									<form method="post" action="<?php echo base_url("/geographic_locations/add_edit/" . $table . "/" . $entity_id . "/" . $id); ?>" enctype="multipart/form-data">
                                        <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
 

										<div class="form-group row">
											<?php $field_name = "label"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-4"><?php echo ucfirst(str_replace("_"," ",$field_name)); ?></label>
											<div class="col-md-8">
												<input type="text" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo $record[$field_name]; } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
											<?php $field_name = "lat"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-4"><?php echo ucfirst(str_replace("_"," ","latitude")); ?></label>
											<div class="col-md-8">
												<input type="number" step="0.0001" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="txtLat<?php $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo number_format($record[$field_name],4); } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

                                        <div class="form-group row">
											<?php $field_name = "lng"; ?>
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-4"><?php echo ucfirst(str_replace("_"," ","longitude")); ?></label>
											<div class="col-md-8">
												<input type="number" step="0.0001" placeholder="" class="<?php echo $field_name; ?> form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="txtLng<?php $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if(isset($record[$field_name])){ echo number_format($record[$field_name],4); } ?>">
                                                <?php if($validation->hasError($field_name)){ ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>

										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>
                                    <br />
									<hr />
									<div class="how-to-guide">
										<strong>Guide</strong>
										<span class="icon-info"></span>
										<p>
											Please click and drag the marker to reposition
											or change the values manually.
										</p>
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
		
		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>		

		<!-- Select 2 -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo config("App")->googleMapApiKey; ?>&v=weekly"
        async
        ></script>

        <script type="text/javascript">
        function initialize() {

            <?php if(isset($record['lat']) && isset($record['lng'])){ ?>
            // Creating map object
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 8,
                center: new google.maps.LatLng(<?php echo $record['lat']; ?>, <?php echo $record['lng']; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo $record['lat']; ?>, <?php echo $record['lng']; ?>),
                draggable: true
            });
            <?php }else{ ?>
            // Creating map object
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 8,
                center: new google.maps.LatLng(7.8742, 80.6511),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(7.8742, 80.6511),
                draggable: true
            });
            <?php } ?>

            // adds a listener to the marker
            // gets the coords when drag event ends
            // then updates the input with the new coords
            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(4));
                $("#txtLng").val(evt.latLng.lng().toFixed(4));

                map.panTo(evt.latLng);
            });

            // centers the map on markers coords
            map.setCenter(vMarker.position);

            // adds the marker on the map
            vMarker.setMap(map);
        }
    </script>

<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
		<!-- Select2 CSS -->
<link rel="stylesheet" href="<?php

        use function PHPUnit\Framework\isEmpty;

 echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">

	<style>
		.pagination {
			display: flex;
			justify-content: center;
			padding-bottom: 10px;
			list-style: none;
		}

		.pagination li {
			margin: 0 5px;
		}

		.pagination a {
			color: #9e1d1d;
			text-decoration: none;
			padding: 8px 16px;
			border: 1px solid #9e1d1d;
			border-radius: 4px;
			transition: background-color 0.3s, color 0.3s;
		}

		.pagination a:hover {
			background-color: #9e1d1d;
			color: white;
		}

		.pagination .active a {
			background-color: #9e1d1d;
			color: white;
			border-color: #9e1d1d;
		}

		.pagination .disabled a {
			color: #ccc;
			pointer-events: none;
			border-color: #ccc;
		}

		.pagination-info {
			margin-top: 10px;
			text-align: center;
		}

	</style>
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
								<?php if(isEmpty($heading)){ ?>
									<h3 class="page-title"><?php echo $heading;?></h3>
								<?php } else {?>
									<h3 class="page-title">Report</h3>
								<?php }?>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Report</li>
								</ul>
							</div>
							<div class="col-auto">
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
					<!-- Search Filter -->
                    <form method="get" action="<?php echo base_url("/reports/dynamic/" . $filter . "/" . $query . "/"); ?>">
					<?= $this->include('common/form_filter') ?>
                    </form>
					<!-- /Search Filter -->
					
					<div class="row">
						<div class="col-sm-12">
							<?php if(isset($list_all) && is_array($list_all)){ ?>
								<?php cano_get_alert();?>
							<?php } ?>
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
									<?php if(isset($list_all) && is_array($list_all)){ ?>
										<table class="table table-center table-hover datatable_export">
											<thead class="thead-light">
												<tr>
													<th>No</th>
                                                    <?php 
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
                                                    <td><?php echo $key + 1; ?></td>
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
											</tbody>
										</table>
										<div class="pagination-container">
											
											<p class="pagination-info">Showing <?= $start ?> to <?= $end ?> of <?= $total ?> entries</p>
											<ul class="pagination">
												<?= $pager_links ?>
											</ul>
										</div>
									<?php }else{ ?>
										<h4 style="text-align:center;">Please Select appropriate Filter for Load this Report.</h4>
									<?php } ?>
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
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
		<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>
        
		<script>
            $(document).ready(function(){
                $('.datatable_export').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ]
                });

				$( ".datepicker" ).datepicker({ minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true });
				$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
				
				// destroy alert in 10 seconds
				setTimeout(function() {
					$('.alert').alert('close');
				}, 10000);
			});
        </script>
<!-- Select 2 -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

<script>
$( function() {
	$(".search-select").select2();
});
</script>
	</body>
</html>
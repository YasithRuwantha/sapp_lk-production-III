
<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
		
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
								<h3 class="page-title">4P Registration</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">4P Registration</li>
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
                    <form method="get" action="<?php echo base_url("/reports/loan_profile/"); ?>">
					<?= $this->include('common/form_filter') ?>
                    </form>
					<!-- /Search Filter -->
					
					<div class="row">
						<div class="col-sm-12">
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
                                    <?php if(isset($list_all) && is_array($list_all)){ ?>
										<table class="table table-center table-hover datatable_export">
											<thead class="thead-light">
												<tr>
													<th>No</th>
                                                    <th>Borrower Type</th>
                                                    <th>NIC</th>
                                                    <th>Last Name</th>
                                                    <th>Other Names / Initials</th>
                                                    <th>Gender</th>
                                                    <th>Address Line 1</th>
                                                    <th>Address Line 2</th>
                                                    <th>Address Line 3</th>
                                                    <th>Telephone</th>
                                                    <th>E-Mail</th>
                                                    <th>Educational Level</th>
                                                    <th>Loan Scheme</th>
                                                    <th>Bank Code</th>
                                                    <th>Bank</th>
                                                    <th>Branch Code</th>
                                                    <th>Branch</th>
                                                    <th>Status of the Applicant</th>
                                                    <th>Participaring Company/FO/PO/FG Name</th>
                                                    <th>Main Purpose</th>

                                                    <th>Sub Purpose</th>
                                                    <th>Sub-Sub purpose</th>
                                                    <th>Project Name</th>
                                                    <th>Project Type (New/Existing)</th>
                                                    <th>Project/Business District</th>

                                                    <th>Project/Business Site Address Line 1</th>
                                                    <th>Project/Business  Site Address Line 2</th>
                                                    <th>Project/Business  Site Address Line 3</th>
                                                    <th>Project/Business  Site Telephone</th>
                                                    <th>Project/Business  Site Email</th>

                                                    <th>Project/Business Business Type</th>
                                                    <th>Estimated Project Cost</th>
                                                    <th>Recommended Amount</th>
                                                    <th>PFI Reference</th>
                                                    <th>Remarks</th>

                                                    <th>Loan Number</th>
                                                    <th>Registration date</th>
												</tr>
											</thead>
											<tbody>
                                            <?php 
                                            if(isset($list_all) && is_array($list_all)){
                                                foreach($list_all as $key=>$val){
                                            ?>
												<tr>
                                                    <td><?php echo $key + 1; ?></td>													
                                                    <td><?php if(isset($barrower_type[$val['barrower_type']])){ echo $barrower_type[$val['barrower_type']]; } ?></td>
													<td><?php echo $val['pin']; ?></td>
                                                    <td><?php echo $val['lname']; ?></td>
                                                    <td><?php echo $val['fname']; ?></td>
                                                    <td><?php if(isset($gender[$val['gender']])){ echo $gender[$val['gender']]; } ?></td>
                                                    <td><?php echo $val['address_no']; ?></td>
                                                    <td><?php echo $val['address_street']; ?></td>
                                                    <td><?php echo $val['address_city']; ?></td>
                                                    <td><?php echo $val['mobile']; ?></td>
                                                    <td><?php echo $val['email']; ?></td>
                                                    <td><?php if(isset($heighest_education_qualification[$val['heighest_education_qualification']])){ echo $heighest_education_qualification[$val['heighest_education_qualification']]; } ?></td>
                                                    <td><?php echo $val['loan_scheme_name']; ?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td><?php if(isset($project_type[$val['project_type']])){ echo $project_type[$val['project_type']]; } ?></td>
                                                    <td>&nbsp;</td>

                                                    <td><?php echo $val['address_no']; ?></td>
                                                    <td><?php echo $val['address_street']; ?></td>
                                                    <td><?php echo $val['address_city']; ?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>
                                                    <td><?php echo $val['est_loan_amount']; ?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?php echo $val['pfi_ref_no']; ?></td>
                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>
                                                    <td><?php echo $val['loan_disbursement_date']; ?></td>
												</tr>
                                            <?php
                                                }
                                            }
                                            ?>
											</tbody>
										</table>
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
            });
        </script>
	</body>
</html>
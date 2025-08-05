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
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Sales Report</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
									<li class="breadcrumb-item active">Reports</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="#"  class="btn btn-primary me-1">
									<i class="fas fa-file-pdf"></i>
								</a>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" @click="toggleContent" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
			   
					<!-- Search Filter -->
					<div id="filter_inputs" class="card filter-card">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Slect Date Range</label>
										<select class="select">
											<option>Select</option>
											<option>Today</option>
											<option>This Week</option>
											<option>This Month</option>
											<option>This Quarter</option>
											<option>This Year</option>
											<option>Previous Week</option>
											<option>Previous Month</option>
											<option>Previous Quarter</option>
											<option>Previous Year</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>From</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>To</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable" id="customerTable">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Date</th>
													<th>Category</th>
													<th>Sales</th>
													<th>Refunded</th>
													<th>Discounts</th>
													<th>Taxs</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>7 Jan 2021</td>
													<td>Accessories</td>
													<td>$42</td>
													<td>$0</td>
													<td>$163</td>
													<td>$221</td>
													<td>$762</td>
												</tr>
												<tr>
													<td>2</td>
													<td>28 Feb 2021</td>
													<td>Books</td>
													<td>$1249</td>
													<td>$36</td>
													<td>$3</td>
													<td>$80</td>
													<td>$1238</td>
												</tr>
												<tr>
													<td>3</td>
													<td>10 Mar 2021</td>
													<td>Others</td>
													<td>$76</td>
													<td>$0</td>
													<td>$0</td>
													<td>$4</td>
													<td>$80</td>
												</tr>
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
</template>
<script>
import customers from '../assets/json/customers.json';
const images = require.context('../assets/img/profiles', false, /\.png$|\.jpg$/)
export default {
	data() {
		return {
			customers: customers
		}
	},
	mounted() {
		// Select 2
	if ($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}
	// Datetimepicker
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD-MM-YYYY',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
		});
	}
	if ($('.datatable').length > 0) {
		$('.datatable').DataTable({
			"bFilter": false,
		});
	}
	$(document).on('click', '#filter_search', function() {
			$('#filter_inputs').slideToggle("slow");
		});
	
	},
	methods: {
        loadImg(imgPath) {
            return images('./' + imgPath).default
		}
        
    },
}
</script>
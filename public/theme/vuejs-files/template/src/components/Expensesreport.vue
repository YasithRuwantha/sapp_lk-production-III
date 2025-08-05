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
								<h3 class="page-title">Expenses Report</h3>
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
								<div class="col-md-3">
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
								<div class="col-md-3">
									<div class="form-group">
										<label>Category:</label>
										<select class="select">
											<option>Select Category</option>
											<option>Advertising</option>
											<option>Marketing</option>
											<option>Software</option>
											<option>Travel</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>From</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-3">
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
													<th>Category</th>
													<th>Customer</th>
													<th>Expense Date</th>
													<th>Amount</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Advertising</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-04.jpg" alt="User Image"> Barbara Moore</router-link>
														</h2>
													</td>
													<td>15 Nov 2020</td>
													<td>$145</td>
													<td><span class="badge badge-pill bg-success-light">Approved</span></td>
													
												</tr>
												<tr>
													<td>Marketing</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-02.jpg" alt="User Image"> Brian Johnson</router-link>
														</h2>
													</td>
													<td>11 Nov 2020</td>
													<td>$254</td>
													<td><span class="badge badge-pill bg-danger-light">Pending</span></td>
													
												</tr>
												<tr>
													<td>Software</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-05.jpg" alt="User Image"> Greg Lynch</router-link>
														</h2>
													</td>
													<td>23 Oct 2020</td>
													<td>$145</td>
													<td><span class="badge badge-pill bg-success-light">Approved</span></td>
													
												</tr>
												<tr>
													<td>Travel</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-06.jpg" alt="User Image"> Karlene Chaidez</router-link>
														</h2>
													</td>
													<td>9 Oct 2020</td>
													<td>$75</td>
													<td><span class="badge badge-pill bg-success-light">Approved</span></td>
													
												</tr>
												<tr>
													<td>Repairs</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-03.jpg" alt="User Image"> Marie Canales</router-link>
														</h2>
													</td>
													<td>3 Oct 2020</td>
													<td>$60</td>
													<td><span class="badge badge-pill bg-danger-light">Pending</span></td>
													
												</tr>
												<tr>
													<td>Stationary</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-07.jpg" alt="User Image"> John Blair</router-link>
														</h2>
													</td>
													<td>29 Sep 2020</td>
													<td>$154</td>
													<td><span class="badge badge-pill bg-danger-light">Pending</span></td>
													
												</tr>
												<tr>
													<td>Food</td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="../assets/img/profiles/avatar-08.jpg" alt="User Image"> Russell Copeland</router-link>
														</h2>
													</td>
													<td>19 Sep 2020</td>
													<td>$214</td>
													<td><span class="badge badge-pill bg-danger-light">Pending</span></td>
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
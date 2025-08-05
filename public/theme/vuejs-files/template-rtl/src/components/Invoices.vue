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
								<h3 class="page-title">Invoices</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
									<li class="breadcrumb-item active">Invoices</li>
								</ul>
							</div>
							<div class="col-auto">
								<router-link to="/add-invoice" class="btn btn-primary me-1">
									<i class="fas fa-plus"></i>
								</router-link>
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
									<label>Customer:</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Status:</label>
										<select class="select">
											<option>Select Status</option>
											<option>Draft</option>
											<option>Sent</option>
											<option>Viewed</option>
											<option>Expired</option>
											<option>Accepted</option>
											<option>Rejected</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>From</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>To</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Invoice Number</label>
										<input type="text" class="form-control">
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
										<table class="table table-stripped table-hover datatable" id="invoiceTable">
											<thead class="thead-light">
												<tr>
												   <th>Invoice Number</th>
												   <th>Customer Name</th>
												   <th>Created Date</th>
												   <th>Amount</th>
												   <th>Due Date</th>
												   <th>Status</th>
												   <th>Paid On</th>
												   <th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in invoices" :key="item.id">
													<td><router-link to="/view-invoice">{{item.invoice_number}}</router-link></td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" :src="loadImg(item.customer_image)" alt="User Image"> {{item.customer_name}}</router-link>
														</h2>
													</td>
													<td>{{item.created_date}}</td>
													<td>{{item.amount}}</td>
													<td>{{item.due_date}}</td>
													<td><span class="badge bg-success-light">{{item.status}}</span></td>
													<td>{{item.paid_on}}</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<router-link class="dropdown-item" to="/edit-invoice"><i class="far fa-edit me-2"></i>Edit</router-link>
																<router-link class="dropdown-item" to="/view-invoice"><i class="far fa-eye me-2"></i>View</router-link>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
															</div>
														</div>
													</td>
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
import invoices from '../assets/json/invoices.json';
const images = require.context('../assets/img/profiles', false, /\.png$|\.jpg$/)
export default {
	data() {
		return {
			invoices: invoices
		}
	},
	mounted() {
	if ($('.datatable').length > 0) {
		$('.datatable').DataTable({
			"bFilter": false,
		});
	}
    
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
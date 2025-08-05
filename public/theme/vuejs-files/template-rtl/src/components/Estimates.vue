<template>
    <!-- Main Wrapper -->
		<div class="main-wrapper">
            <layout-header></layout-header>
			<layout-sidebar></layout-sidebar>
			
			
						<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Estimates</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link>
									</li>
									<li class="breadcrumb-item active">Estimates</li>
								</ul>
							</div>
							<div class="col-auto">
								<router-link to="/add-estimate" class="btn btn-primary me-2">
									<i class="fas fa-plus"></i>
								</router-link>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" @click="toggleContent" id="filter_search">
									<i class="fas fa-filter"></i>
								</a>
							</div>
						</div>
					</div>
					
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
											<option value="Draft">Draft</option>
											<option value="Sent">Sent</option>
											<option value="Viewed">Viewed</option>
											<option value="Expired">Expired</option>
											<option value="Accepted">Accepted</option>
											<option value="Rejected">Rejected</option>
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
										<label>Estimate Number</label>
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
										<table class="table table-stripped table-hover datatable" id="estimatestable">
											<thead class="thead-light">
												<tr>
													<th>Estimate Number</th>
													<th>Customer</th>
													<th>Estimate Date</th>
													<th>Expiry Date</th>
													<th>Amount</th>
													<th>Status</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in estimates" :key="item.id">
													<td><router-link to="/view-estimate">EST-17ER281</router-link></td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" :src="loadImg(item.customer_image)" alt="User Image"> {{item.customer_name}}</router-link>
														</h2>
													</td>
													<td>{{item.estimated_date}}</td>
													<td>{{item.expiry_date}}</td>
													<td>{{item.amount}}</td>
													<td>
                                                        <span class="badge bg-success-light" v-if="item.status == 'Accepted'">{{item.status}}</span>
                                                        <span class="badge bg-danger-light" v-if="item.status == 'Declined'">{{item.status}}</span>
                                                        <span class="badge bg-info-light" v-if="item.status == 'Sent'">{{item.status}}</span>
                                                         <span class="badge bg-warning-light" v-if="item.status == 'Expired'">{{item.status}}</span>
                                                    </td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<router-link class="dropdown-item" to="/edit-invoice"><i class="far fa-edit me-2"></i>Edit</router-link>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
																<router-link class="dropdown-item" to="/view-estimate"><i class="far fa-eye me-2"></i>View</router-link>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-file-alt me-2"></i>Convert to Invoice</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Estimate</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as Accepted</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-times-circle me-2"></i>Mark as Rejected</a>
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
import estimates from '../assets/json/estimates.json';
const images = require.context('../assets/img/profiles', false, /\.png$|\.jpg$/)
export default {
	data() {
		return {
			estimates: estimates
		}
	},
	mounted() {
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
        if ($('.select').length > 0) {
            $('.select').select2({
                minimumResultsForSearch: -1,
                width: '100%'
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
		},
		toggleContent() {
			this.toggleCheck = !this.toggleCheck;
		}
        
    },
}
</script>
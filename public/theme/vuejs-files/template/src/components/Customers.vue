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
								<h3 class="page-title">Customers</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link>
									</li>
									<li class="breadcrumb-item active">Customers</li>
								</ul>
							</div>
							<div class="col-auto">
								<router-link to="/add-customer" class="btn btn-primary me-2">
									<i class="fas fa-plus"></i>
								</router-link>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
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
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Phone</label>
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
										<table class="table table-center table-hover datatable" id="customerTable">
											<thead class="thead-light">
												<tr>
													<th>Customer</th>
													<th>Email</th>
													<th>Amount Due</th>
													<th>Registered On</th>
													<th>Status</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in customers" :key="item.id">
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" :src="loadImg(item.customer_image)" alt="User Image"></router-link>
															<router-link to="/customer/profile">{{item.customer_name}} <span>{{item.customer_mobile}}</span></router-link>
														</h2>
													</td>
													<td>{{item.customer_email}}</td>
													<td>{{item.amount_due}}</td>
													<td>{{item.registered_on}}</td>
													<td>
														<span class="badge badge-pill bg-success-light" v-if="item.status == 'Active'">Active</span>
														<span class="badge badge-pill bg-danger-light" v-if="item.status == 'Inactive'">Inactive</span>
													</td>
													<td class="text-right">
														<router-link to="/edit-customer" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-2"></i> Edit</router-link> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-2"></i>Delete</a>
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
import customers from '../assets/json/customers.json';
const images = require.context('../assets/img/profiles', false, /\.png$|\.jpg$/)
export default {
	data() {
		return {
			customers: customers
		}
	},
	mounted() {
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
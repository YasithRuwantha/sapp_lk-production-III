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
								<h3 class="page-title">Payments</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
									<li class="breadcrumb-item active">Payments</li>
								</ul>
							</div>
							<div class="col-auto">
								<router-link to="/add-payment"  class="btn btn-primary me-2">
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
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Customer</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Price</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Payment Mode</label>
										<select class="select">
											<option>Payment Mode</option>
											<option>Cash</option>
											<option>Cheque</option>
											<option>Card</option>
											<option>Online</option>
										</select>
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
										<table class="table table-center table-hover datatable" id="paymentTable">
											<thead class="thead-light">
												<tr>
													<th>Reference ID</th>
													<th>Customer</th>
													<th>Amount</th>
													<th>Date</th>
													<th>Payment Method</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in payments" :key="item.id">
													<td><a href="javascript:void(0);">{{item.reference_id}}</a></td>
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" :src="loadImg(item.customer_image)" alt="User Image"> {{item.customer_name}}</router-link>
														</h2>
													</td>
													<td>{{item.amount}}</td>
													<td>{{item.date}}</td>
													<td>{{item.payment_card}} <strong>{{item.card_no}}</strong></td>
													<td class="text-right">
														<a class="btn btn-sm btn-white me-2" href="javascript:void(0);">
															<i class="fas fa-download me-1"></i> PDF
														</a>
														<router-link class="btn btn-sm btn-white ms-1" to="/view-invoice">
															<i class="far fa-eye me-1"></i> View
														</router-link>
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
import payments from '../assets/json/payments.json';
const images = require.context('../assets/img/profiles', false, /\.png$|\.jpg$/)
export default {
	data() {
		return {
			payments: payments
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
		$(document).on('click', '#filter_search', function() {
			$('#filter_inputs').slideToggle("slow");
		});
	},
	methods: {
        loadImg(imgPath) {
            return images('./' + imgPath).default
        },
        
    },
}
</script>
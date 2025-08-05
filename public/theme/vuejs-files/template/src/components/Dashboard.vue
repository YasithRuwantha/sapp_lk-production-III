<template>
    	<!-- Main Wrapper -->
		<div class="main-wrapper">
			<layout-header />
			<layout-sidebar />
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">

					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<i class="fas fa-dollar-sign"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Amount Due</div>
											<div class="dash-counts">
												<p>1,642</p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>1.15%</span> since last week</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<i class="fas fa-users"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Customers</div>
											<div class="dash-counts">
												<p>3,642</p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>2.37%</span> since last week</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-3">
											<i class="fas fa-file-alt"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Invoices</div>
											<div class="dash-counts">
												<p>1,041</p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-4">
											<i class="far fa-file"></i>
										</span> 
										<div class="dash-count">
											<div class="dash-title">Estimates</div>
											<div class="dash-counts">
												<p>2,150</p>
											</div>
										</div>
									</div>
									<div class="progress progress-sm mt-3">
										<div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-7 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="d-flex justify-content-between align-items-center">
										<h5 class="card-title">Sales Analytics</h5>

										<div class="dropdown">
											<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
												Monthly
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<li>
													<a href="javascript:void(0);" class="dropdown-item">Weekly</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">Monthly</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">Yearly</a>
												</li>												
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
										<div class="w-md-100 d-flex align-items-center mb-3">
											<div>
												<span>Total Sales</span>
												<p class="h3 text-primary me-5">$1000</p>
											</div>
											<div>
												<span>Receipts</span>
												<p class="h3 text-success me-5">$1000</p>
											</div>
											<div>
												<span>Expenses</span>
												<p class="h3 text-danger me-5">$300</p>
											</div>
											<div>
												<span>Earnings</span>
												<p class="h3 text-dark me-5">$700</p>
											</div>
										</div>
									</div>
									
									<apexchart height="350" type="bar" :options="chartOptions2" :series="series1"></apexchart>
								</div>
							</div>
						</div>
						<div class="col-xl-5 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="d-flex justify-content-between align-items-center">
										<h5 class="card-title">Invoice Analytics</h5> 
										
										<div class="dropdown">
											<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
												Monthly
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
												<li>
													<a href="javascript:void(0);" class="dropdown-item">Weekly</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">Monthly</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">Yearly</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body">
									<apexchart type="donut" :options="chartOptions1" :series="series"></apexchart>
									<div class="text-center text-muted">
										<div class="row">
											<div class="col-4">
												<div class="mt-4">
													<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> Invoiced</p>
													<h5>$ 2,132</h5>
												</div>
											</div>
											<div class="col-4">
												<div class="mt-4">
													<p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Received</p>
													<h5>$ 1,763</h5>
												</div>
											</div>
											<div class="col-4">
												<div class="mt-4">
													<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i> Pending</p>
													<h5>$ 973</h5>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Recent Invoices</h5>
										</div>
										<div class="col-auto">
											<router-link to="/invoices" class="btn-right btn btn-sm btn-outline-primary">
												View All 
											</router-link>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<div class="progress progress-md rounded-pill mb-3">
											<div class="progress-bar bg-success" role="progressbar" style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
											<div class="progress-bar bg-warning" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
											<div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
											<div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="row">
											<div class="col-auto">
												<i class="fas fa-circle text-success me-1"></i> Paid
											</div>
											<div class="col-auto">
												<i class="fas fa-circle text-warning me-1"></i> Unpaid
											</div>
											<div class="col-auto">
												<i class="fas fa-circle text-danger me-1"></i> Overdue
											</div>
											<div class="col-auto">
												<i class="fas fa-circle text-info me-1"></i> Draft
											</div>
										</div>
									</div>
				
									<div class="table-responsive">
									
										<table class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												   <th>Customer</th>
												   <th>Amount</th>
												   <th>Due Date</th>
												   <th>Status</th>
												   <th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in recentinvoices" :key="item.id">
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" :src="loadImg(item.image)" alt="User Image">{{item.customer_name}}</router-link>
														</h2>
													</td>
													<td>{{item.amount}}</td>
													<td>{{item.due_date}}</td>
													<td>
														<span class="badge bg-success-light" v-if="item.status == 'Paid'">{{item.status}}</span>
														<span class="badge bg-info-light" v-if="item.status == 'Sent'">{{item.status}}</span>
														<span class="badge bg-warning-light" v-if="item.status == 'Partially Paid'">{{item.status}}</span>
														<span class="badge bg-danger-light" v-if="item.status == 'Overdue'">{{item.status}}</span>
													</td>
													<td class="text-right">
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
						<div class="col-md-6 col-sm-6">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Recent Estimates</h5>
										</div>
										<div class="col-auto">
											<router-link to="/estimates" class="btn-right btn btn-sm btn-outline-primary">
												View All 
											</router-link>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<div class="progress progress-md rounded-pill mb-3">
											<div class="progress-bar bg-success" role="progressbar" style="width: 39%" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
											<div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
											<div class="progress-bar bg-warning" role="progressbar" style="width: 26%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="row">
											<div class="col-auto">
												<i class="fas fa-circle text-success me-1"></i> Sent
											</div>
											<div class="col-auto">
												<i class="fas fa-circle text-warning me-1"></i> Draft
											</div>
											<div class="col-auto">
												<i class="fas fa-circle text-danger me-1"></i> Expired
											</div>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-hover">
											<thead class="thead-light">
												<tr>
													<th>Customer</th>
													<th>Expiry Date</th>
													<th>Amount</th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in recentestimates" :key="item.id">
													<td>
														<h2 class="table-avatar">
															<router-link to="/customer/profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" :src="loadImg(item.image)" alt="User Image">{{item.customer_name}}</router-link>
														</h2>
													</td>
													<td>{{item.expiry_date}}</td>
													<td>{{item.amount}}</td>
													<td>
														<span class="badge bg-info-light" v-if="item.status == 'Sent'">{{item.status}}</span>
														<span class="badge bg-warning-light" v-if="item.status == 'Expired'">{{item.status}}</span>
														<span class="badge bg-success-light" v-if="item.status == 'Accepted'">{{item.status}}</span>
													</td>
													<td class="text-right">
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
import recentestimates from '../assets/json/recentestimates.json';
import recentinvoices from '../assets/json/recentinvoices.json';
import VueApexCharts from "vue3-apexcharts";
const images = require.context('../assets/img/profiles', false, /\.png$|\.jpg$/)
export default {
	components: {
    apexchart: VueApexCharts,
  },
	data() {
		return {
			recentinvoices: recentinvoices,
			recentestimates: recentestimates,
		   chartOptions1: {
		   	colors: ['#7638ff', '#ff737b', '#fda600', '#1ec1b0'],
		   	chart: {
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			type: 'donut',
		},
		labels: ['Paid', 'Unpaid', 'Overdue', 'Draft'],
		legend: {show: false},
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 200
				},
				legend: {
					position: 'bottom'
				}
			}
		}]

		   },
		
      series: [55, 40, 20, 10],
      series1: [{
			name: "Received",
			type: "column",
			data: [70, 150, 80, 180, 150, 175, 201, 60, 200, 120, 190, 160, 50]
			},
			{
			name: "Pending",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			}
          ],
           chartOptions2: {
           	colors: ['#7638ff', '#fda600'],
            chart: {
			type: 'bar',
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			toolbar: {
				show: false
			}
		},
            plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '60%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
		},
		yaxis: {
			title: {
				text: '$ (thousands)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "$ " + val + " thousands"
				}
			}
		}
          },
		}
	},
    mounted() {
        
	},
	 methods: {
        loadImg(imgPath) {
            return images('./' + imgPath).default
        },
        
    },
}
</script>
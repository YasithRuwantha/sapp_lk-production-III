<?php $page="invoices";?>
@extends('layout.mainlayout')
@section('content')		


<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
			
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Invoices</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Invoices</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="add-invoice" class="btn btn-primary">
									<i class="fas fa-plus"></i>
								</a>
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
										<table class="table table-stripped table-hover datatable">
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
												<tr>
													<td><a href="view-invoice">INV-65ZTE15</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-04.jpg" alt="User Image"> Barbara Moore</a>
														</h2>
													</td>
													<td>16 Nov 2020</td>
													<td>$118</td>
													<td>23 Nov 2020</td>
													<td><span class="badge bg-success-light">Paid</span></td>
													<td>23 Nov 2020, 10:45pm</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="edit-invoice"><i class="far fa-edit me-2"></i>Edit</a>
																<a class="dropdown-item" href="view-invoice"><i class="far fa-eye me-2"></i>View</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="view-invoice">INV-65ZTE15</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-06.jpg" alt="User Image"> Karlene Chaidez</a>
														</h2>
													</td>
													<td>14 Nov 2020</td>
													<td>$222</td>
													<td>18 Nov 2020</td>
													<td><span class="badge bg-info-light">Sent</span></td>
													<td>20 Nov 2020, 7:22pm</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="edit-invoice"><i class="far fa-edit me-2"></i>Edit</a>
																<a class="dropdown-item" href="view-invoice"><i class="far fa-eye me-2"></i>View</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="view-invoice">INV-65ZTE15</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-08.jpg" alt="User Image"> Russell Copeland</a>
														</h2>
													</td>
													<td>7 Nov 2020</td>
													<td>$347</td>
													<td>10 Nov 2020</td>
													<td><span class="badge bg-warning-light">Partially Paid</span></td>
													<td>13 Nov 2020, 8:30am</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="edit-invoice"><i class="far fa-edit me-2"></i>Edit</a>
																<a class="dropdown-item" href="view-invoice"><i class="far fa-eye me-2"></i>View</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="view-invoice">INV-65ZTE15</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-10.jpg" alt="User Image"> Joseph Collins</a>
														</h2>
													</td>
													<td>24 Sep 2020</td>
													<td>$826</td>
													<td>25 Sep 2020</td>
													<td><span class="badge bg-danger-light">Overdue</span></td>
													<td>27 Sep 2020, 6:10pm</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="edit-invoice"><i class="far fa-edit me-2"></i>Edit</a>
																<a class="dropdown-item" href="view-invoice"><i class="far fa-eye me-2"></i>View</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
																<a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="view-invoice">INV-65ZTE15</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-11.jpg" alt="User Image"> Jennifer Floyd</a>
														</h2>
													</td>
													<td>17 Sep 2020</td>
													<td>$519</td>
													<td>18 Sep 2020</td>
													<td><span class="badge bg-success-light">Paid</span></td>
													<td>19 Sep 2020, 7:50pm</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="edit-invoice"><i class="far fa-edit me-2"></i>Edit</a>
																<a class="dropdown-item" href="view-invoice"><i class="far fa-eye me-2"></i>View</a>
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
@endsection
<?php $page="add-invoice";?>
@extends('layout.mainlayout')
@section('content')		

<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Invoice</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="invoices">Invoices</a></li>
									<li class="breadcrumb-item active">Add Invoice</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form action="#">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Customer:</label>
													<select class="select">
														<option>Select Customer</option>
														<option>Brian Johnson</option>
														<option>Marie Canales</option>
														<option>Barbara Moore</option>
														<option>Greg Lynch</option>
														<option>Karlene Chaidez</option>
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
											<div class="col-md-4 mt-3">
												<div class="form-group">
													<label>Estimate Number</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="col-md-4 mt-3">
												<div class="form-group">
													<label>Ref Number</label>
													<input type="text" class="form-control">
												</div>
											</div>
										</div>
										<div class="table-responsive mt-4">
											<table class="table table-center table-hover">
												<thead>
													<tr>
														<th>Items</th>
														<th>Quantity</th>
														<th>Price</th>
														<th>Amount</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<input type="text" class="form-control">
														</td>
														<td>
															<input type="text" class="form-control">
														</td>
														<td>
															<input type="text" class="form-control">
														</td>
														<td>
															<input type="text" class="form-control" disabled>
														</td>
														<td class="add-remove text-end">
															<i class="fas fa-plus-circle"></i > <i class="fas fa-minus-circle"></i> 
														</td>
													</tr>
													<tr>
														<td>
															<input type="text" class="form-control">
														</td>
														<td>
															<input type="text" class="form-control">
														</td>
														<td>
															<input type="text" class="form-control">
														</td>
														<td>
															<input type="text" class="form-control" disabled>
														</td>
														<td class="add-remove text-end">
															<i class="fas fa-plus-circle"></i > <i class="fas fa-minus-circle"></i> 
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="table-responsive mt-4">
											<table class="table table-stripped table-center table-hover">
												<thead></thead>
												<tbody>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-end">Sub Total</td>
														<td class="text-end">0</td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-end">Discount</td>
														<td class="text-end">0</td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-end">Total</td>
														<td class="text-end">0</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="text-end mt-4">
											<button type="submit" class="btn btn-primary">Add Invoice</button>
										</div>
									</form>
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
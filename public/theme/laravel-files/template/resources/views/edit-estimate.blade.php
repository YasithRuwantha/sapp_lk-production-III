<?php $page="edit-estimate";?>
@extends('layout.mainlayout')
@section('content')		

<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
					
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Estimate</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="estimates">Estimate</a></li>
									<li class="breadcrumb-item active">Edit Estimate</li>
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
													<input type="text" class="form-control" value="#Edk555AS">
												</div>
											</div>
											<div class="col-md-4 mt-3">
												<div class="form-group">
													<label>Ref Number</label>
													<input type="text" class="form-control" value="#IkL555AS">
												</div>
											</div>
										</div>
										<div class="table-responsive mt-4">
											<table class="table table-stripped table-center table-hover">
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
															<input type="text" class="form-control" value="Website Design">
														</td>
														<td>
															<input type="text" class="form-control" value="10">
														</td>
														<td>
															<input type="text" class="form-control" value="$30">
														</td>
														<td>
															<input type="text" class="form-control" value="$300" disabled>
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
														<td class="text-end">$300</td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-end">Discount</td>
														<td class="text-end">$17</td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-end">Total</td>
														<td class="text-end">$283</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="text-end mt-4">
											<button type="submit" class="btn btn-primary">Update Estimate</button>
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
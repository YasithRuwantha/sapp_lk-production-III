<?php $page="edit-expenses";?>
@extends('layout.mainlayout')
@section('content')		


<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Expenses</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="expenses">Expenses</a>
									</li>
									<li class="breadcrumb-item active">Add Expenses</li>
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
											<div class="col-md-6">
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
												<div class="form-group">
													<label>Note:</label>
													<textarea rows="5" cols="5" class="form-control" placeholder="Ut et est et autem quaerat. Dolores consequuntur ut "></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Date:</label>
													<div class="cal-icon">
														<input class="form-control datetimepicker" type="text">
													</div>
												</div>
												<div class="form-group">
													<label>Customer:</label>
													<input type="text" class="form-control" value="Karlene Chaidez" disabled>
												</div>
												<div class="form-group">
													<label>Amount:</label>
													<input type="text" class="form-control" value="$75">
												</div>
												<div class="text-end mt-4">
													<button type="submit" class="btn btn-primary">Save Changes</button>
												</div>
											</div>
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
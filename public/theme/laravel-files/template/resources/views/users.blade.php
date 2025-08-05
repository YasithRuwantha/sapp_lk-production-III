<?php $page="users";?>
@extends('layout.mainlayout')
@section('content')		
	
	<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Users</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Users</li>
								</ul>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-header">
									<h4 class="card-title">List of Users</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>Name</th>
													<th>Email</th>
													<th>Registered On</th>
													<th>Role</th>
													<th>Status</th>
													<th class="text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-01.jpg" alt="User Image"> Charles Hafner</a>
														</h2>
													</td>
													<td>charleshafner@example.com</td>
													<td>16 Nov 2020</td>
													<td><span class="text-success">Admin</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-02.jpg" alt="User Image"> Brian Johnson</a>
														</h2>
													</td>
													<td>brianjohnson@example.com</td>
													<td>16 Nov 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-03.jpg" alt="User Image"> Marie Canales</a>
														</h2>
													</td>
													<td>mariecanales@example.com</td>
													<td>8 Nov 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-danger-light">Inactive</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-04.jpg" alt="User Image"> Barbara Moore</a>
														</h2>
													</td>
													<td>barbaramoore@example.com</td>
													<td>24 Oct 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-05.jpg" alt="User Image"> Greg Lynch</a>
														</h2>
													</td>
													<td>greglynch@example.com</td>
													<td>11 Oct 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-danger-light">Inactive</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-06.jpg" alt="User Image"> Karlene Chaidez</a>
														</h2>
													</td>
													<td>karlenechaidez@example.com</td>
													<td>29 Sep 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-danger-light">Inactive</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-07.jpg" alt="User Image"> John Blair</a>
														</h2>
													</td>
													<td>johnblair@example.com</td>
													<td>13 Aug 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-08.jpg" alt="User Image"> Russell Copeland</a>
														</h2>
													</td>
													<td>russellcopeland@example.com</td>
													<td>2 Jul 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-danger-light">Inactive</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-09.jpg" alt="User Image"> Leatha Bailey</a>
														</h2>
													</td>
													<td>leathabailey@example.com</td>
													<td>20 Jun 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-10.jpg" alt="User Image"> Joseph Collins</a>
														</h2>
													</td>
													<td>josephcollins@example.com</td>
													<td>9 May 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-11.jpg" alt="User Image"> Jennifer Floyd</a>
														</h2>
													</td>
													<td>jenniferfloyd@example.com</td>
													<td>17 Apr 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-12.jpg" alt="User Image"> Alex Campbell</a>
														</h2>
													</td>
													<td>alexcampbell@example.com</td>
													<td>30 Mar 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="profile"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/profiles/avatar-13.jpg" alt="User Image"> Wendell Ward</a>
														</h2>
													</td>
													<td>wendellward@example.com</td>
													<td>22 Feb 2020</td>
													<td><span class="text-info">Customer</span></td>
													<td><span class="badge badge-pill bg-success-light">Active</span></td>
													<td class="text-end">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
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
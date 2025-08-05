<template>
    <!-- Main Wrapper -->
		<div class="main-wrapper">
            <layout-header></layout-header>
			<layout-sidebar></layout-sidebar>
			
		   <!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-6">
							<h3 class="page-title">Settings</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link>
								</li>
								<li class="breadcrumb-item active">Notifications</li>
							</ul>
						</div>
					</div>
				</div>
				
					<div class="row">
						<div class="col-xl-3 col-md-4">
                            <layout-settings-sidebar></layout-settings-sidebar>
						</div>
						
						<div class="col-xl-9 col-md-8">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Notifications</h5>
									<p>Which email notifications would you like to receive when something changes?</p>
								</div>
								<div class="card-body">
								
									<!-- Form -->
									<form>
										<div class="row form-group">
											<label for="notificationmail" class="col-sm-3 col-form-label input-label">Send Notifications to</label>
											<div class="col-sm-9">
												<input type="email" class="form-control" id="notificationmail">
											</div>
										</div>


										<!-- Toggle Switch -->
										<label class="row form-group toggle-switch" for="notification_switch1">
											<span class="col-8 col-sm-9 toggle-switch-content ms-0">
												<span class="d-block text-dark">Invoice viewed</span>
												<span class="d-block text-muted">When your customer views the invoice sent via dashboard.</span>
											</span>
											<span class="col-4 col-sm-3">
												<input type="checkbox" class="toggle-switch-input" id="notification_switch1">
												<span class="toggle-switch-label ms-auto">
													<span class="toggle-switch-indicator"></span>
												</span>
											</span>
										</label>
										<!-- /Toggle Switch -->

										<!-- Toggle Switch -->
										<label class="row form-group toggle-switch" for="notification_switch2">
											<span class="col-8 col-sm-9 toggle-switch-content ms-0">
												<span class="d-block text-dark">Estimate viewed</span>
												<span class="d-block text-muted">When your customer views the estimate sent via dashboard.</span>
											</span>
											<span class="col-4 col-sm-3">
												<input type="checkbox" class="toggle-switch-input" id="notification_switch2">
												<span class="toggle-switch-label ms-auto">
													<span class="toggle-switch-indicator"></span>
												</span>
											</span>
										</label>
										<!-- /Toggle Switch -->
										
										<div class="text-end">
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</div>
									</form>
									<!-- /Form -->
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
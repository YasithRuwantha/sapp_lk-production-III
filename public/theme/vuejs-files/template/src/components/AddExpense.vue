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
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Expenses</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><router-link to="/">Dashboard</router-link>
									</li>
									<li class="breadcrumb-item"><router-link to="/expenses">Expenses</router-link>
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
													<textarea rows="5" cols="5" class="form-control"></textarea>
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
													<input type="text" class="form-control">
												</div>
												<div class="form-group">
													<label>Amount:</label>
													<input type="text" class="form-control">
												</div>
												<div class="text-end mt-4">
													<button type="submit" class="btn btn-primary">Add Expenses</button>
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
</template>
<script>

export default {
	mounted() {
         if ($('.select').length > 0) {
            $('.select').select2({
                minimumResultsForSearch: -1,
                width: '100%'
            });
        }
        if ($('.datetimepicker').length > 0) {
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY',
                icons: {
                    up: "fa fa-angle-up",
                    down: "fa fa-angle-down",
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                }
            });
            $('.datetimepicker').on('dp.show', function () {
                $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
            }).on('dp.hide', function () {
                $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
            });
        }
	},
}
</script>
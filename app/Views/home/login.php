<!DOCTYPE html>
<html lang="en">
	<head>
        <?= $this->include('common/html_head') ?>
		
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper login-body">
			<div class="login-wrapper">
				<div class="container">
				
					<img class="img-fluid logo-dark mb-2" src="<?php echo base_url("/public/theme/html-files/template/assets/img/logo.png"); ?>" alt="Logo">
					<div class="loginbox">
						
						<div class="login-right">
							<div class="login-right-wrap">
								<h1>Login</h1>
								<p class="account-subtitle">Access to the system</p>
								<?php cano_get_alert(); ?>
								<form method="post" action="<?php echo base_url("/user/login/"); ?>" enctype="multipart/form-data">
									<div class="form-group">
										<label class="form-control-label">Email / Phone</label>
										<input name="user" type="text" class="form-control">
									</div>
									<div class="form-group">
										<label class="form-control-label">Password</label>
										<div class="pass-group">
											<input name="pwd" type="password" class="form-control pass-input">
											<span class="fas fa-eye toggle-password"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
                                            <!--
											<div class="col-6">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="cb1">
													<label class="custom-control-label" for="cb1">Remember me</label>
												</div>
											</div>
                                            -->
											<div class="col-6">
												<a class="forgot-link" href="<?php echo base_url("/user/forget/"); ?>">Forgot Password ?</a>
											</div>
                                            
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>
                                    <!--
									<div class="login-or">
										<span class="or-line"></span>
										<span class="span-or">or</span>
									</div>
									
									<div class="social-login mb-3">
										<span>Login with</span>
										<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a>
									</div>
									
									<div class="text-center dont-have">Don't have an account yet? <a href="register.html">Register</a></div>
                                    -->
                                </form>
								
							</div>
						</div>
					</div>

					<div class="login_canopus_credits">
						Designed & Developed by <a href="https://www.canopus.lk/" target="_blank">Canopus (Pvt) Ltd</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/jquery-3.6.0.min.js"); ?>"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/bootstrap.bundle.min.js"); ?>"></script>
		
		<!-- Feather Icon JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/feather.min.js"); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>

	</body>
</html>
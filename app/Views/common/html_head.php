       <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>SAPP</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url("/public/theme/html-files/template/assets/img/favicon.png"); ?>">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/css/bootstrap.min.css"); ?>">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/fontawesome/css/fontawesome.min.css"); ?>">
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/plugins/fontawesome/css/all.min.css"); ?>">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="<?php echo base_url("/public/theme/html-files/template/assets/css/style.css?" . date('YmdHm')) . rand(1,9999); ?>">
		
		<!--[if lt IE 9]>
			<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/html5shiv.min.js"); ?>"></script>
			<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/respond.min.js"); ?>"></script>
		<![endif]-->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
		<?php $abbreviations = json_decode(get_config(18),TRUE); ?>
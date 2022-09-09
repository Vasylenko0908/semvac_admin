<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php echo S_SITE; ?></title>
		<meta name="keywords" content="SEMVAC" />
		<meta name="description" content="SEMVAC Admin Panel">
		<meta name="author" content="Radmir">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<!--link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/SEMVAC_Logo.png">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.theme.default.css" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/theme-custom.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Head Libs -->
		<script src="<?php echo base_url();?>assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<section class="body" style="background: #313131;">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
<!-- 						<img src="assets/images/logo.png" height="35" alt="Porto Admin" /> -->
						<p style="font-size: 35px; font-family: fantasy; font-weight: bold;"><?php echo S_SITE; ?></p>
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo base_url();?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="<?php echo base_url();?>assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $_SESSION[S_SITE][S_DATA]['userid']; ?></span>
								<span class="role"><?php echo $_SESSION[S_SITE][S_DATA]['type']; ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url();?>index.php/admin/go_profile"><i class="fa fa-user"></i> My Profile</a>
								</li>
								
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url();?>index.php/signin"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Side Menu
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li <?php if ($page == 'dashboard') echo 'class="nav-active"'; ?>>
										<a href="<?php echo base_url();?>index.php/admin">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									
									<li <?php if ($page == 'articles') echo 'class="nav-active"'; ?>>
										<a href="<?php echo base_url();?>index.php/admin/go_articles">
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Articles</span>
										</a>
									</li>
									


								</ul>
							</nav>
				
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

		<!-- Vendor -->
		<script src="<?php echo base_url();?>assets/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url();?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo base_url();?>assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="<?php echo base_url();?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<!-- Specific Page Vendor -->
		<script src="<?php echo base_url();?>assets/vendor/owl.carousel/owl.carousel.js"></script>
		<script src="<?php echo base_url();?>assets/vendor/pnotify/pnotify.custom.js"></script>



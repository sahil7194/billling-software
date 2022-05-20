<?php
	require 'config.php';

	//check login status 
	  session_start();
	  $username=$_SESSION['user'];
	  $password=$_SESSION['pass'];
	  $profile=$_SESSION['profile'];
	  if ($username!="" && $password!="")
	 {
	  
	  $select_login="SELECT `id`, `username`, `password`, `profile` FROM `user` WHERE `username`='$username' AND`password`='$password'";
	  $run_login=mysqli_query($conn,$select_login);
	  $count=mysqli_num_rows($run_login);
	  if ($count==1&&$profile=="staff")
	  {
	    
	  }
	  else
	  {
	    //for testing on  local server 
	    header('Location:'.$base_location.'/index.php');
	    
	  }
	}
	else
	{
	  header('Location:'.$base_location.'/index.php');
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $page_title;?></title>
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/vendors/base/vendor.bundle.base.css">
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/css/style.css">
	<link rel="shortcut icon" href="<?php echo $base_location;?>/assets/images/favicon.png" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<style type="text/css">
		.main-container
		{
			border: 1px solid red;
			height: 550px;
			overflow-y: auto;
		}
	</style>

	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<script src="<?php echo $base_location;?>/assets/vendors/base/vendor.bundle.base.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo $base_location;?>/assets/vendors/chart.js/Chart.min.js"></script>
	
	<script src="<?php echo $base_location;?>/assets/js/off-canvas.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/hoverable-collapse.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/template.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/sweet_alert.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/dashboard.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/data-table.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/jquery.dataTables.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/dataTables.bootstrap4.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/fontaws.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/jquery.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/jquery.cookie.js" type="text/javascript"></script>
	
</head>
<body>
	<div class="container-scroller">
		<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="navbar-brand-wrapper d-flex justify-content-center">
				<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
					<a class="navbar-brand brand-logo" href="<?php echo $base_location;?>/staff/index.php">
						<img src="<?php echo $base_location;?>/assets/images/favicon.png" alt="logo"/>
					</a>
					<a class="navbar-brand brand-logo-mini" href="<?php echo $base_location;?>/staff/index.php">
						<img src="<?php echo $base_location;?>/assets/images/favicon.png" alt="logo"/>
					</a>
					<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
						<span class="mdi mdi-sort-variant"></span>
					</button>
				</div>  
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">	
				<div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>&nbsp;/&nbsp;
                    <p class="text-primary mb-0 hover-cursor"><?php echo $page_icon; echo $page_title;?></p>
                  </div>			
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item nav-profile dropdown mr-2">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
							<!--<img src="<?php echo $base_location;?>/assets/images/faces/face5.jpg" alt="profile"/>-->
							<span class="nav-profile-name">staff</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
							<!--<a class="dropdown-item">
								<i class="mdi mdi-settings text-primary"></i>
								Settings
							</a>-->
							<a class="dropdown-item" href="<?php echo $base_location;?>/logout.php">
								<i class="mdi mdi-logout text-primary"></i>
								Logout
							</a>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
					<span class="mdi mdi-menu"></span>
				</button>
			</div>
		</nav>
		
		<div class="container-fluid page-body-wrapper">
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $base_location;?>/staff/index.php">
							<i class="mdi mdi-home menu-icon"></i>
							<span class="menu-title">Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#office" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-playlist-check menu-icon"></i>
							<span class="menu-title">Office Info</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="office">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/staff/add_order.php">
										Add Order
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/staff/manage_order.php">	
										Manage Order
									</a>
								</li>								
							</ul>
						</div>						
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $base_location;?>/logout.php">
							<i class="mdi mdi-logout menu-icon"></i>
							<span class="menu-title">Logout</span>
						</a>
					</li>
				</ul>
			</nav>

			<div class="main-panel">
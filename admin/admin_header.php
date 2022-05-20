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
	  if ($count==1&&$profile=="admin")
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
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/vendors/base/vendor.bundle.base.css">
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo $base_location;?>/assets/css/style.css">
	<link rel="shortcut icon" href="<?php echo $base_location;?>/assets/images/favicon.png" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<style type="text/css">
		.main-container
		{
			border: 1px solid red;
			height: 550px;
			overflow-y: auto;
		}
	</style>

	<script src="<?php echo $base_location;?>/assets/vendors/base/vendor.bundle.base.js"></script>
	
	<script src="<?php echo $base_location;?>/assets/vendors/chart.js/Chart.min.js"></script>
	<script src="<?php echo $base_location;?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
	<script src="<?php echo $base_location;?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
	
	<script src="<?php echo $base_location;?>/assets/js/off-canvas.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/hoverable-collapse.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/template.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/sweet_alert.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/dashboard.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/data-table.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/jquery.dataTables.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/dataTables.bootstrap4.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/fontaws.js"></script>
	<script src="<?php echo $base_location;?>/assets/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="<?php echo $base_location;?>/assets/js/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
</head>
<body>
	<div class="container-scroller">
		<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="navbar-brand-wrapper d-flex justify-content-center">
				<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
					<a class="navbar-brand brand-logo" href="<?php echo $base_location;?>/admin/index.php">
						<img src="<?php echo $base_location;?>/assets/images/favicon.png" alt="logo"/>
					</a>
					<a class="navbar-brand brand-logo-mini" href="<?php echo $base_location;?>/admin/index.php">
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
							<span class="nav-profile-name">Admin</span>
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
						<a class="nav-link" href="<?php echo $base_location;?>/admin/index.php">
							<i class="mdi mdi-home menu-icon"></i>
							<span class="menu-title">Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#office" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-office menu-icon"></i>
							<span class="menu-title">Office Info</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="office">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/office/add_new_office.php">Add New Office</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/office/manage_office.php">Manage</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/office/office_letter.php">Agreement</a>
								</li>
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#services" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-shape-plus menu-icon"></i>
							<span class="menu-title">Services</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="services">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/services/active_new_services.php">Active New Services</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/services/active_services_status.php">Active Services Status</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/services/add_new_services.php">Add New Services</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/services/manage_services.php">Manage Services</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/services/order_summary.php">Order Summary</a>
								</li>								
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-currency-inr menu-icon"></i>
							<span class="menu-title">Payment</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="payment">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/payment/new_payment.php">Create Sells Invoice</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/payment/manage_sells_invoice.php"> Manage Sells Invoice </a>
								</li>
								<!-- <li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/payment/make_sells_payment.php">Make Sells Payment</a>
								</li> -->
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/payment/create_purchase_invoice.php"> Create Purchase Invoice </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/payment/manage_purches_invoice.php"> Manage Purchase Invoice </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/payment/pending_payment.php">Payment Summary</a>
								</li>																
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#supplier" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-escalator menu-icon"></i>
							<span class="menu-title">Supplier</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="supplier">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/supplier/add_new_supplier.php"> Add New supplier</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/supplier/manage_supplier.php">Manage supplier</a>
								</li>																
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#item" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-sitemap menu-icon"></i>
							<span class="menu-title">item</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="item">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/item/add_new_item.php"> Add New item</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/item/manage_item.php">Manage item</a>
								</li>																
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#purchase" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-book-open-variant menu-icon"></i>
							<span class="menu-title">Purchase</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="purchase">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/purchase/add_new_purchase.php"> Add New purchase</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/purchase/manage_purchase.php">Manage purchase</a>
								</li>																
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-account-plus menu-icon"></i>
							<span class="menu-title">User</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="user">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/user/add_new_user.php"> Add New User</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/user/manage_user.php">Manage User</a>
								</li>																
							</ul>
						</div>						
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#staff" aria-expanded="false" aria-controls="ui-basic">
							<i class="mdi mdi-human-male-female menu-icon"></i>
							<span class="menu-title">Staff</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="staff">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/add_new_staff.php"> Add New Staff</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/manage_staff.php">Manage Staff</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/add_advances.php">Add Advances</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/manage_advances.php">Manage advances</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/add_salary.php">Add Salary</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/manage_salary.php">Manage salary</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/add_attendance.php">Add Attendance</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $base_location;?>/admin/staff/manage_attendance.php">Manage Attendance</a>
								</li>															
							</ul>
						</div>						
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $base_location;?>/admin/admin_office_configuration.php">
							<i class="mdi mdi-ticket-confirmation menu-icon"></i>
							<span class="menu-title">Configure</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $base_location;?>/logout.php">
							<i class="mdi mdi-home menu-icon"></i>
							<span class="menu-title">Logout</span>
						</a>
					</li>
				</ul>
			</nav>

			<div class="main-panel">
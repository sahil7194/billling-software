<?php  
require 'config.php';
$msg="";
  if (isset($_POST['submit']))
  {
    $msg="";
    //include 'config.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

    $select_login_query="SELECT `id`, `username`, `password`, `profile`, `user_form`, `ActiveStatus`,`status`FROM `user` WHERE `username`='$username' AND `password`='$password' AND `status`='0' ;";
    $run_login_query=mysqli_query($conn,$select_login_query);

   $cout=mysqli_num_rows($run_login_query);
    $profile="";
    $activestatus="";
    while ($row_profile=mysqli_fetch_array($run_login_query))
    {
      $profile=$row_profile['profile'];
      $activestatus=$row_profile['ActiveStatus'];
    } 

    if ($cout>0)
    {
      if ($activestatus=="on")
      {
        $msg="ready login";

        switch ($profile)
         {
            case 'admin':
              header('Location: admin/index.php');
              session_start();
              $_SESSION['user']=$username;
              $_SESSION['pass']=$password;
              $_SESSION['profile']=$profile;
            break;

            case 'staff':
              header('Location: staff/index.php');
              session_start();
              $_SESSION['user']=$username;
              $_SESSION['pass']=$password;
              $_SESSION['profile']=$profile;
            break;

            case 'partner':
              header('Location: partern/index.php');
              session_start();
              $_SESSION['user']=$username;
              $_SESSION['pass']=$password;
              $_SESSION['profile']=$profile;
            break;

            case 'office':
              header('Location: office/index.php');
              session_start();
              $_SESSION['user']=$username;
              $_SESSION['pass']=$password;
              $_SESSION['profile']=$profile;
            break;
        }
      }
      else
      {
        $msg="Your login is disabled <br> Contact Admin";
      }

    }
    else
    {
      $msg="<strong></strong>";
    }



  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin Login</title>
	<link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="./assets/vendors/base/vendor.bundle.base.css">
	<link rel="stylesheet" href="./assets/css/style.css">
	<link rel="shortcut icon" href="./assets/images/favicon.png"/>
</head>

<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth px-0">
				<div class="row w-100 mx-0">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left py-5 px-4 px-sm-5">
							<!--<div class="brand-logo">
								<img src="./assets/images/favicon.png" alt="logo">
							</div>-->
							<h4 class="text-center">Login</h4>
							<h6 class="font-weight-light text-center justify-content-between"><?php echo $msg;?></h6>
							<form action="" method="post" class="pt-3">
								<div class="form-group">
									<input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
								</div>
								<div class="mt-3">
									<button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit">Login</button>
									<!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="./assets/index.html">LOGIN</a> -->
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<div class="form-check">
										<!-- <label class="form-check-label text-muted">
											<input type="checkbox" class="form-check-input">
											Keep me signed in
										</label> -->
									</div>
									<!-- <a href="resetpass.php" class="auth-link text-black">Forgot password?</a> -->
								</div>
								<div class="text-center mt-4 font-weight-light">
									<!-- Don't have an account? <a href="register.php" class="text-primary">Create</a> -->
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
	
	<script src="./assets/vendors/base/vendor.bundle.base.js"></script>
	
	<script src="./assets/js/off-canvas.js"></script>
	<script src="./assets/js/hoverable-collapse.js"></script>
	<script src="./assets/js/template.js"></script>
</body>

</html>

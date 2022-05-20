<?php
session_start();
	  $username=$_SESSION['user'];
	  $password=$_SESSION['pass'];
require 'config.php';
function servicesname($servicesid)
{
	require 'config.php';

	$select="SELECT `service_name` FROM `services` WHERE `id`='$servicesid'";
	$run=mysqli_query($conn,$select);
	while ($row=mysqli_fetch_array($run))
	{
		$name=$row['service_name'];
	}

	return $name;
}

  function services_type($username,$password)
  {
    require 'config.php';

      $select="SELECT  `services_type` FROM `user` WHERE `username`='$username' AND `password`='$password';";
      $run=mysqli_query($conn,$select);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['services_type'];
      }

      return $name;
  }

if ($_POST['request'])
 {
	$serv=$_POST['request'];
 	 $services_type=services_type($username,$password); 

	$select_services="SELECT services_status.id, services.service_name,services.price_type ,services.id as `serid` FROM services_status INNER JOIN services ON services_status.ServiceId=services.id WHERE services_status.CompanyID='$serv' AND services.price_type ='$services_type' AND services_status.ServiceStatus='on'
";
	$run_services=mysqli_query($conn,$select_services);

	if (mysqli_num_rows($run_services)>0)
	{
		echo '<option disabled="" selected="">-- Select Services  --</option>';
		while ($row_services=mysqli_fetch_array($run_services))
		{
			
			?><option value="<?php echo $row_services['serid'];?>"><?php echo $row_services['service_name'];?> </option>
			<?php
			
		}
		
	}
	else
	{
		echo "<option>-- No Data Found --</option>";
	}
}
?>
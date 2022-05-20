<?php
require 'config.php'; 
	if (isset($_POST['request2'])) 
	{
		$services_id=$_POST['request2'];

		$select_service_price="SELECT `id`,`price_type` FROM `services` WHERE `id`='$services_id'";
		$run_services_price=mysqli_query($conn,$select_service_price);
		while ($row_services_price=mysqli_fetch_array($run_services_price))
		{
			echo $row_services_price['price_type'];
			
		}
		
	}
 ?>
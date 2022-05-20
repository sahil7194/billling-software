<?php 
	$base_location="http://localhost/new/bill";
	$conn=mysqli_connect("localhost","root","","billing_kanade");
	if ($conn == true)
	{
		$select_company_details="SELECT `client_name`, `address`, `client_contact_no`, `gst_no`, `client_logo`, `date` FROM `configuration`";
		$run_company_details=mysqli_query($conn,$select_company_details);
		while ($row_comapany_details=mysqli_fetch_array($run_company_details)) 
		{
			$company_name=$row_comapany_details['client_name'];
			$company_address=$row_comapany_details['address'];
			$company_contact_no=$row_comapany_details['client_contact_no'];
			$gst_no=$row_comapany_details['gst_no'];
			$company_logo=$row_comapany_details['client_logo'];

		}
	}
	else
	{
		echo "connection fail";
	}
 ?>
<?php
////config section 
date_default_timezone_set('Asia/Kolkata');
$today=date('Y-m-d');
$current_month=date('m');
		$base_location="http://localhost/new/bill";
		$conn=mysqli_connect("localhost","root","","billing_kanade");
		if ($conn == true)
		{
			$select_company_details="SELECT `client_name`, `address`, `client_contact_no`, `gst_no`, `client_logo`, `date`,`bank_name`,`a_c`,`branch`,`ifsc` FROM `configuration`";
			$run_company_details=mysqli_query($conn,$select_company_details);
			while ($row_comapany_details=mysqli_fetch_array($run_company_details)) 
			{
				$company_name=$row_comapany_details['client_name'];
				$company_address=$row_comapany_details['address'];
				$company_contact_no=$row_comapany_details['client_contact_no'];
				$gst_no=$row_comapany_details['gst_no'];
				$company_logo=$row_comapany_details['client_logo'];
				$bank_name=$row_comapany_details['bank_name'];
				$a_c=$row_comapany_details['a_c'];
				$branch=$row_comapany_details['branch'];
				$ifsc=$row_comapany_details['ifsc'];
			}
		}
		else
		{
			echo "connection fail";
		}
?>
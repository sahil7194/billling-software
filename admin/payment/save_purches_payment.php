<?php 
require 'services_function.php';
require '../config.php';
if (isset($_POST['invoice_id'])) 
{
	$invoice_id=$_POST['invoice_id'];
	$amount=$_POST['amount'];
	$mode=$_POST['mode'];
	$old=$_POST['old'];

	
	$new=$old+$amount;
	 $sql_for_save_payment="INSERT INTO `purches_payment`(`invoice_id`, `amount`, `mode`) VALUES ('$invoice_id','$amount','$mode');";
	 $sql_update_paid="UPDATE `purches_invoice` SET `paid_amount`='$amount' WHERE `id`='$invoice_id';";
	 $new_sql=$sql_for_save_payment.$sql_update_paid;
	 $run_multiple = mysqli_multi_query($conn,$new_sql);

		if ($run_multiple==true)
		 {
			echo "Data Save";
		}
		else
		{
			echo "Fail to Save";
		}
	
}
?>
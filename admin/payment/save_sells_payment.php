<?php 
require 'services_function.php';
require '../config.php';
if (isset($_POST['invoice_id'])) 
{
	$invoice_id=$_POST['invoice_id'];
	$amount=$_POST['amount'];
	$mode=$_POST['mode'];
	//add old payment
	//toget old paid amount 
	$sql_to_get_old_paid_amount="SELECT  `paid_amount` FROM `sells_invoice_data` WHERE `id`='$invoice_id';";
	$run_to_get_old_paid_amount=mysqli_query($conn,$sql_to_get_old_paid_amount);
	while ($row_to_get_old_paid_payment=mysqli_fetch_array($run_to_get_old_paid_amount)) 
	{
		$old_payment=$row_to_get_old_paid_payment['paid_amount'];
	}

	$sql_for_save_payment="INSERT INTO `sells_payment`(`invoice_id`, `amount`, `mode`) VALUES ('$invoice_id','$amount','$mode')";
	$run_for_save_payment=mysqli_query($conn,$sql_for_save_payment);
	if ($run_for_save_payment==true) 
	{
		$new_payment=$old_payment+$amount;
		$sql_update_paid="UPDATE `sells_invoice_data` SET `paid_amount`='$new_payment' WHERE `id`='$invoice_id';";
		$run_update_paid=mysqli_query($conn,$sql_update_paid);
		if ($run_update_paid==true)
		 {
			echo "Data Save";
		}
		else
		{
			echo "Fail to Save";
		}
	}
}
?>
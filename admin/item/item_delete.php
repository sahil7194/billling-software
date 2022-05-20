<?php 
	require '../config.php';
	$supplier_id=$_GET['supplier_id'];
	$item_id=$_GET['item_id'];
	if ($supplier_id!=""&&$item_id!="")
	{
		$sql_for_update="UPDATE `item_data` SET `status`='1' WHERE `id`='$item_id' AND `supplier_id`='$supplier_id';";
		$run_for_update=mysqli_query($conn,$sql_for_update);
		if ($run_for_update)
		{
			header('Location: manage_item.php');
		}
		else
		{
			header('Location: manage_item.php');	
		}
	}
	else
	{
		header('Location: manage_item.php');
	}
?>
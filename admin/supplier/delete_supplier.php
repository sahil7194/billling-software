<?php 
	require '../config.php';
	$id=$_GET['id'];
	if ($id!="")
	{
		$sql_for_update="UPDATE `supplier` SET `status`='1' WHERE `id`='$id';";
		$run_for_update=mysqli_query($conn,$sql_for_update);
		if ($run_for_update)
		{
			header('Location: manage_supplier.php');
		}
		else
		{
			header('Location: manage_supplier.php');	
		}
	}
	else
	{
		header('Location: manage_supplier.php');
	}
?>
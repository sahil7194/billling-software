<?php 
require '../config.php';
if (isset($_POST['staff'])) 
{
	$staff=$_POST['staff'];
	$month=$_POST['month'];

	$sql_for_ad="SELECT Sum(`amount`)as `total` FROM `advances` WHERE MONTH(`date`)='$month' AND `staff_id`='$staff';";
	$run_for_ad=mysqli_query($conn,$sql_for_ad);
	while ($row_for_ad=mysqli_fetch_array($run_for_ad))
	{
		$ad=$row_for_ad['total'];
	}
//get sal

	
	$sql_for_sal="SELECT `salary_amunt` FROM `staff` WHERE `id`='$staff';";
	$run_for_sal=mysqli_query($conn,$sql_for_sal);
	while ($row_for_sal=mysqli_fetch_array($run_for_sal))
	{
		$sal=$row_for_sal['salary_amunt'];
	}

	echo $amount=$sal-$ad;
}

?>
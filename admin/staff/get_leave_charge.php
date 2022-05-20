<?php 
require '../config.php';
if (isset($_POST['staff']))
{
	$staff=$_POST['staff'];
	$month=$_POST['month'];
	$year=date('Y');
	$sql_get_sal="SELECT `salary_amunt` FROM `staff` WHERE `id`='$staff';";
	$run_get_sal=mysqli_query($conn,$sql_get_sal);
	while ($row_sal=mysqli_fetch_array($run_get_sal))
	{
	 $sal=$row_sal['salary_amunt'];
	}

	$d=cal_days_in_month(CAL_GREGORIAN,$month,$year);

	echo intval($sal/$d);
}
?>
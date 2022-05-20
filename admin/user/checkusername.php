<?php
require '../config.php';

	if (isset($_POST['username'])) 
	{
		$username=$_POST['username'];
		$sql="SELECT `id` FROM `user` WHERE `username`='$username';";
		$run=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($run);
		echo $count;
	}
	
?>
<?php 	
	function clientname($i)
  {
    require '../config.php';
    $select="SELECT `office_name`FROM `office_deatils` WHERE `id`='$i'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo $client_name=$row['office_name'];
      
    }
  }
 ?>
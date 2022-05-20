<?php 
	if (isset($_POST['check']))
	{
		echo "<pre>";
		print_r($_POST['check']);

		echo "<br>";

		echo json_encode($_POST['check']);
	}
 ?>
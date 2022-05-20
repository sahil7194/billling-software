<?php 
require 'services_function.php';
	if(isset($_POST['id'])){
		$id=$_POST['id'];
		
		echo purches_pending_payment($id);	
	}
?>
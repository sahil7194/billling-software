<?php 
require 'services_function.php';
	if(isset($_POST['id'])){
		$id=$_POST['id'];
		
		echo sells_pending_payment($id);	
	}
?>
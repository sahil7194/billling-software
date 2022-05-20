<?php 	
require 'services_function.php';
	if (isset($_POST['companyid']))
	{
		$company_id=$_POST['companyid'];
		$min_active_status_date=min_active_status_date($company_id);
		$today=date('Y-m-d');
		?>
		<div class="row">
	         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
	            <div class="form-group">

	               <label for="form-data">Form Date</label>
	               <input type="date" min="<?php echo $min_active_status_date?>" max="<?php echo $today;?>" name="from_date" id="form-data" class="form-control">
	            </div>
	        </div>

	        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
	            <div class="form-group">
	               <label for="to-data">To Date</label>
	               <input type="date" min="<?php echo $min_active_status_date?>" max="<?php echo $today;?>" name="to_date" id="to-data" class="form-control">
	            </div>
	        </div>
	     </div> 
       <?php
	}
 ?>
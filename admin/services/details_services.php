<?php 
   $page_title="Services Details";
   $page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';

	function companyname($companyid)
	{
		require '../config.php';

		$select="SELECT `id`, `office_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$companyid'";
		$run=mysqli_query($conn,$select);
		while ($row=mysqli_fetch_array($run))
		{
			$name=$row['office_name'];
		}

		return $name;
	}
	function servicesname($servicesid)
	{
		require '../config.php';

		$select="SELECT `id`, `service_name`, `service_des`, `price_type`, `date` FROM `services` WHERE `id`='$servicesid'";
		$run=mysqli_query($conn,$select);
		while ($row=mysqli_fetch_array($run))
		{
			$name=$row['service_name'];
		}

		return $name;
	}

	function check_services_old_status($office_id,$servicesid)
	{
		require '../config.php';
		$status;
		$sql_for_check="SELECT  `ServiceStatus` FROM `services_status` WHERE `CompanyID`='$office_id' AND `ServiceId`='$servicesid'";
		$run_for_check=mysqli_query($conn,$sql_for_check);
		while ($row_for_check=mysqli_fetch_array($run_for_check))
		{
			$status=$row_for_check['ServiceStatus'];
		}
		
		return $status;
	}
	$id=$_GET['id'];
   require '../admin_header.php';
   ?>
    <div class="content-wrapper">
      <div class="grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4> 

             <div class="container-fluid" style="margin-top:15px;">
              	<h3><?php echo companyname($id); ?></h3>
              		<div  style="height: 410px; overflow: auto;">
              			<form action="" method="post">
              		<table class="table table-hover">
                    <thead>
	                  <tr>
	                    <th scope="col">#</th>
	                    <th scope="col"> Select Services</th>
	                    <th scope="col"> Services Name </th>
	                    <th scope="col"> Price </th>
	                    <th scope="col"> Active Date </th>
	                    <th scope="col"> Deactive Date </th>
	                    <th scope="col"> Last Billing Date </th>
	                    <th scope="col"> Services Status </th>
	                    <th scope="col">Change Status</th>
	                  </tr>
	                </thead>
	                <tbody>
	                	<?php 
	                	$c=0;
	                		$sql_services_data="SELECT `id`, `CompanyID`, `ServiceId`, `price`, `ServiceStatus`, `ActiveDate`, `Deactivate`, `LastBillingDate`, `LastUpDate` FROM `services_status` WHERE `CompanyID`='$id'";
	                		$run_services_data=mysqli_query($conn,$sql_services_data);
	                		while ($row_services_data=mysqli_fetch_array($run_services_data))
	                		{
	                			$c=$c+1;
	                			?>
	                			<tr>
	                				<td>
	                					<?php echo $c;?>
	                				</td>
	                				<td>
	                					<input type="checkbox" name="check[]" value="<?php echo $row_services_data['ServiceId'];?>">
	                				</td>
	                				<td>
	                					<?php echo servicesname($row_services_data['ServiceId']);?>
	                				</td>
	                				<td>
	                					<?php echo $row_services_data['price'];?>
	                				</td>
	                				<td>
	                					<?php echo $row_services_data['ActiveDate'];?>
	                				</td>
	                				<td>
	                					<?php echo $row_services_data['Deactivate'];?>
	                				</td>
	                				<td>
	                					<?php echo $row_services_data['LastBillingDate'];?>
	                				</td>	                				
	                				<td>
	                					<?php echo $row_services_data['ServiceStatus'];?>
	                				</td>
	                				<td>
	                					<select name="status[]" id="status">
	                						<option selected disabled>chage services status</option>
	                						<option value="on">on</option>
	                						<option value="off">off</option>
	                					</select>
	                				</td>
	                			</tr>
	                			 
	                			  <?php     			  
	                		}
	                	 ?>
	                </tbody>
              		</table>
              		</div>
              		<div class="text-right " style="margin-right: 60px; margin-top:30px;">
              			<button class="btn btn-primary" name="update" id="update">update</button>
              		</div>
              	</form>    
              	<?php 
              	error_reporting('0');
              	$comapny_id=$_GET['id'];
              		if (isset($_POST['update']))
              		{
              			 $today=date('Y-m-d');
              			 $check=$_POST['check'];
              			 $status=$_POST['status'];
              			 if (sizeof($check)==sizeof($status))
              			 {
              			 	for ($i=0; $i <sizeof($check) ; $i++) 
              			 	{ 
              			 		$status_check=check_services_old_status($comapny_id,$check[$i]);
              			 		
              			 		if ($status_check!=$status[$i])
              			 		{
              			 			$update;
              			 			if ($status[$i]=='off')
              			 			{
              			 				$update="UPDATE `services_status` SET `ServiceStatus`='$status[$i]',`LastUpDate`='$today' , `Deactivate`='$today' WHERE `CompanyID`='$comapny_id' AND `ServiceId`='$check[$i]'";
              			 			}
              			 			else
              			 			{
              			 				$update="UPDATE `services_status` SET `ServiceStatus`='$status[$i]',`LastUpDate`='$today' , `ActiveDate`='$today' WHERE `CompanyID`='$comapny_id' AND `ServiceId`='$check[$i]'";
              			 			}

              			 			 $run=mysqli_query($conn,$update);
              			 			 if ($run==true)
              			 			 {
              			 			 	?>
              			 			 	<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
															<strong>Status</strong> Status Updated.
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
              			 			 	<?php
              			 			 }
              			 			 else
              			 			 {
              			 			 	?>
              			 			 	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
															<strong>Status</strong> Some thing worng.
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
              			 			 	<?php
              			 			 }
              			 		}
              			 		else
              			 		{
              			 			?>              			 					
              			 			<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
														<strong>Status</strong> this is cuurent status.
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
              			 			<?php
              			 		}
              			 	}
              			 			
              			 }
              			 else
              			 {
              			 	?>              			 	
              			 	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
												<strong>Status</strong> Services And status did not match
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
              			 	 <?php
              			 }
              		}
              	 ?>          		
              	</div>
         
          </div>
         </div>
	   </div>
   </div>
   <?php
      require '../admin_footer.php';
 ?>
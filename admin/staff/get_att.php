<?php 	
require '../config.php';
	if (isset($_POST['date'])) 
	{
		 $date=$_POST['date'];
	}

	  function staff_name($id)
		{
		  require '../config.php';
			$name='';
			  $select="SELECT `full_name` FROM `staff` WHERE `id`='$id';";
			  $run=mysqli_query($conn,$select);
			  while ($row=mysqli_fetch_array($run))
			  {
			    $name=$row['full_name'];
			  }

			  return $name;
		}
?>
		 <div class="table-responsive">
			<table class="table table-hover">
                <thead>          
                  <tr>
                    <th scope="col"> Sr. No.</th> 
                    <th scope="col"> Staff Name </th> 
                    <th scope="col"> Status  </th>                  
                  </tr>
                </thead>
                <tbody id="staff_data">
                <?php
                	$sql_for_get_att_data="SELECT `id`, `staff_id`, DATE_FORMAT(`date`,'%d-%m-%Y') as `date`, `status` FROM `attendances` WHERE `date`='$date';";
					$run_for_get_att_data=mysqli_query($conn,$sql_for_get_att_data);
					while ($row_for_get_att_data=mysqli_fetch_array($run_for_get_att_data)) 
					{
						$sr=0;
						$sr=$sr+1;
						?>
						<tr>	
							<td>
								<?php echo $sr; ?>
							</td>
							<td>
								<?php echo staff_name($row_for_get_att_data['staff_id']); ?>
							</td>
							<td>
								<?php echo $row_for_get_att_data['date']; ?>
							</td>
						</tr>
						<?php
					}
                ?>
                </tbody>
            </table>
        </div>
		
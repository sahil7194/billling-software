<?php 
   $page_title="Add Attendance";
   $page_icon='<i class="mdi mdi-human-male-female menu-icon"></i>&nbsp;&nbsp';
   require '../admin_header.php';
?>
   <div class="content-wrapper">
   	<div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post"> 
             <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
               <div class="form-group">
                 <label for="usertype">Staff</label>
                 <select class="form-control" id="usertype" name="usertype">
                   <option selected disabled>Select staff</option>
                  	<?php 
                  		$sql_for_get_user="SELECT `id`, `full_name` FROM `staff` ORDER BY `full_name`";
                  		$run_for_get_user=mysqli_query($conn,$sql_for_get_user);
                  		while ($row_for_get_user=mysqli_fetch_array($run_for_get_user)) 
                  		{
                  			?>
                  			<option value="<?php echo $row_for_get_user['id'];?>"><?php echo $row_for_get_user['full_name'];?></option>
                  			<?php
                  		}
                  	 ?>
                 </select>
               </div>
                 </div>
                    <?php
            			$date=date('Y-m-d');
              			$min_date=date('Y-m-d', strtotime('-3 day', strtotime($date)))
           			 ?>
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="userfrom">Date</label>
                       <input type="date" name="date" min="<?php echo $min_date?>" max="<?php echo $date;?>" class="form-control">
                     </div>
                 </div>

               </div>
               <div class="out">
                     
                 </div>
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <select class="form-control" name="status">
                       	<option selected disabled>Select Status</option>
                       	<option value="1">Present</option>
                       	<option value="0">Absent</option>
                       </select>
                    </div>
                 </div>
                 
               </div>
                           
              <button type="submit" name="submit" class="btn btn-primary mr-2" id="submit">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
            <?php    		
		   		if (isset($_POST['submit']))
		   		 {
		   			$usertype=$_POST['usertype'];
					$date=$_POST['date'];
					$status=$_POST['status'];

					if ($usertype!="")
					{
					 $sql_for_insert_att="INSERT INTO `attendances`(`staff_id`, `date`, `status`) VALUES ('$usertype','$date','$status');";
						$run_for_insert_att=mysqli_query($conn,$sql_for_insert_att);
						if ($run_for_insert_att==true) 
						{
							 echo '<script>swal("", "Data Save !", "success")</script>';
						}
						else
						{
							 echo '<script>swal("", "Fail to Add!", "error")</script>';
						}
					}
					else
					{
						 echo '<script>swal("", "Fail to Add !", "error")</script>';
					}
		   		}
		    ?>
          </div>
        </div>
      </div> 
   </div>
   
<?php
  require '../admin_footer.php';
?>
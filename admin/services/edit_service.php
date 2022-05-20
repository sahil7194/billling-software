<?php 
		$page_title="Edit Services";
		$page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';
		require '../admin_header.php';
   
     $id=$_GET['id'];                  
    $sql_for_table_data="SELECT `id`, `service_name`, `service_des`, `price_type`, `HSN`FROM `services` WHERE `id`='$id';";   
    $run_select=mysqli_query($conn,$sql_for_table_data);
    while ($table_row=mysqli_fetch_array($run_select))
      {
      	$_old_service_name=$table_row['service_name'];
		$_old_service_des=$table_row['service_des'];
		$_old_price_type=$table_row['price_type'];
		$_old_HSN=$table_row['HSN'];
      }
                             
   
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">
               <div class="form-group">
                  <label for="service_name">Services Name</label>
                  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="<?php echo $_old_service_name?>" value="<?php echo $_old_service_name?>">
               </div>
               <div class="form-group">
                  <label for="service_des">Service Description</label>
                  <textarea class="form-control" id="service_des" name="service_des" rows="4" placeholder="<?php echo $_old_service_des;?>" required></textarea>
                    </div>
               <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="hsn">HSN/SAC</label>
                        <input type="text" class="form-control" id="hsn" name="hsn" placeholder="<?php echo $_old_HSN;?>" value="<?php echo $_old_HSN;?>" >
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="price_type">Price Type</label><br><small>Old price type :- <?php echo $_old_price_type;?></small>
                       <select class="form-control" id="price_type" name="price_type" required>
                         <option selected disabled>Select Price Type</option>
                         <option value="unit">Per Unit </option>
                        <option value="month">Per Month</option>
                       </select>
                     </div>
                 </div>
                 
                 
              </div>              
               
              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div>   
   <?php
      require '../admin_footer.php';

      if (isset($_POST['submit']))
      {
          $service_name=$_POST['service_name'];
          $services_des=$_POST['service_des'];
          $price_type=$_POST['price_type'];
          $hsn=$_POST['hsn'];
         
          
           	if ($service_name!="")
           	{
           		$service_name_update=$service_name;
           	}
           	else
           	{
           		$service_name_update=$_old_service_name;
           	}

           	if ($services_des!="")
           	{
           		$service_des_update=$services_des;
           	}
           	else
           	{
           		$service_des_update=$_old_service_des;
           	}

           	if ($price_type!="")
           	{
           		$price_type_update=$price_type;
           	}
           	else
           	{
           		$price_type_update=$_old_price_type;
           	}

           	if ($hsn!="")
           	{
           		$hsn_update=$hsn;
           	}
           	else
           	{
           		$hsn_update=$_old_HSN;
           	}
            
            $sql_for_update="UPDATE `services` SET `HSN`='$hsn_update',`service_name`='$service_name_update',`service_des`='$service_des_update',`price_type`='$price_type_update' WHERE `id`='$id';";
            $run_for_update=mysqli_query($conn,$sql_for_update);
            if ($run_for_update) 
            {
                echo '<script>swal("", "Services Successfully Edited!", "success")</script>';
            }
            else
            {
                echo '<script>swal("", "some thing worng!", "error")</script>';
            }
    }
 ?>
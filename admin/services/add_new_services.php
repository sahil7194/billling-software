<?php 
   $page_title="Add New Services";
   $page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';

?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">
               <div class="form-group">
                  <label for="service_name">Services Name</label>
                  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="" required>
               </div>
               <div class="form-group">
                  <label for="service_des">Service Description</label>
                  <textarea class="form-control" id="service_des" name="service_des" rows="4" placeholder="Service Description" required></textarea>
                    </div>
               <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="hsn">HSN/SAC</label>
                        <input type="text" class="form-control" id="hsn" name="hsn" placeholder="HSN/SAC" required>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="price_type">Price Type</label>
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
            $sql_for_insert="INSERT INTO `services`(`service_name`, `service_des`, `price_type`,`HSN`) VALUES ('$service_name','$services_des','$price_type','$hsn')";
            $run=mysqli_query($conn,$sql_for_insert);

            if ($run==true)
            {
              echo '<script>swal("", "Service Successfully Add !", "success")</script>';
            }
            else
            {
               echo '<script>swal(" Opps !", "Fail to Save", "error")</script>';
            }
          }
          else
           {
              echo '<script>swal(" Opps !", "Services Name Required", "error")</script>';
          }
      }
 ?>
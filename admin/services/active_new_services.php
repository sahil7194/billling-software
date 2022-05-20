<?php 
   $page_title="Active New Services";
   $page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';

?>
<?php 
   require '../admin_header.php';

   function CheckServices($c_id,$s_id)
    {
      require '../config.php';

        $select_data="SELECT `id`, `CompanyID`, `ServiceId` FROM `services_status` WHERE `CompanyID`='$c_id' AND `ServiceId`='$s_id'";
        $run=mysqli_query($conn,$select_data);
        $rows=mysqli_num_rows($run);
        $flag;
        if ($rows==0)
         {
            $flag=0;
        }
        else
        {
            $flag=1;
        }

        return $flag;
    }  

    function servicesname($s_id)
    {
      require '../config.php';

      $select="SELECT `id`, `service_name` FROM `services` WHERE `id`='$s_id'";
      $run=mysqli_query($conn,$select);
      while ($row=mysqli_fetch_array($run))
      {
          $service=$row['service_name'];
      }

      echo $service;
    }

   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">
               <div class="form-group">
                 <label for="companyid">Select Office</label>
                 <select class="form-control" id="companyid" name="companyid">
                   <option selected disabled>-- Select Office --</option>
                    <?php 
                        $sql_for_com="SELECT `id`, `office_name` FROM `office_deatils` WHERE `status`='0' ORDER BY `code` ASC";
                        $run_for_com=mysqli_query($conn,$sql_for_com);
                        if (mysqli_num_rows($run_for_com)==0)
                        {
                            ?>
                                <option> NO data found</option>
                            <?php
                        }
                        else
                        {
                            while ($row_for_com=mysqli_fetch_array($run_for_com)) 
                            {
                              ?>
                              <option value="<?php echo $row_for_com['id'];?>"><?php echo $row_for_com['office_name'];?></option>
                              <?php
                            }
                        }
                       
                     ?>
                 </select>
               </div>
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="services">Select Services</label>
                       <select class="form-control" id="services" name="services">
                         <option selected disabled>Select Services</option>
                         <?php 
                                $sql_for_bom="SELECT `id`, `service_name` FROM `services` ORDER BY `service_name` ASC";
                                $run_for_bom=mysqli_query($conn,$sql_for_bom);
                                if (mysqli_num_rows($run_for_bom)==0)
                                {
                                    ?>
                                        <option> NO data found</option>
                                    <?php
                                }
                                else
                                {
                                    while ($row_for_bom=mysqli_fetch_array($run_for_bom)) 
                                    {
                                      ?>
                                      <option value="<?php echo $row_for_bom['id'];?>"><?php echo $row_for_bom['service_name'];?></option>
                                      <?php
                                    }
                                }   
                             ?>
                       </select>
                     </div>
                 </div>
                 
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="price">Services price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Services price">
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
                $office=$_POST['companyid'];
                $services_id=$_POST['services'];
                $price=$_POST['price'];
                $today=date('Y-m-d');
                $status = CheckServices($office,$services_id);
                if ($status==0)
                {
                  
                  $sql_for_insert_service="INSERT INTO `services_status`(`CompanyID`, `ServiceId`, `price`, `ServiceStatus`,`ActiveDate`,`LastUpDate`) VALUES ('$office','$services_id','$price','on','$today','$today')";
                  $run_for_insert_service=mysqli_query($conn,$sql_for_insert_service);
                  if ($run_for_insert_service==true)
                  {
                    echo '<script>swal("", "Services is activated", "success")</script>';
                  }
                  else
                  {
                    echo '<script>swal("", "some thing worng", "error")</script>';
                  }
                }
                else
                {
                  echo '<script>swal("", "This services already activated", "error")</script>';
                }
              }
    ?>
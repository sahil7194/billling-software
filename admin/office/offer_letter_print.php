<?php
require '../config.php';
require '../function_for_office.php';
  $id=$_GET['id'];
  
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
<!--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->
<link rel="stylesheet" href="<?php echo $base_location;?>/assets/css/style.css">
    <title>Print offer letter</title>
  </head>
  <body>
    <div class="container-fluid" id="print_content" >
      <div class="row" style="margin-top:140px; padding-left: 80px; padding-right: 50px;">
        <div class="col-1"> 
          
        </div>
        <div class="col-10"> 
          <div align="right" style="margin-top:20px;" class="text-end">
            Date :- <?php echo date('d-M-Y');?>
          </div>
          <div class="text-start" style="width: 400px;">
            <strong>
                To :
            </strong>
            <!-- Data coming form database -->
        
              <?php 
              //comapny details 
                echo "<br> <b>".$company_name."</b>";
                echo "<br>".$company_address;                
                echo "<br> GST : ".$gst_no;
                echo "<br> Contact :- ".$company_contact_no;
             ?>
           
           
          </div>
           <br>
           <div class="text-center" align="center">
             <u> Contract Details </u> 
           </div>
           <br>
          
           <div style="padding:10px 10px 10px 10px;">
             <!-- para 1 start -->
            <?php echo "<b>".$company_name."</b>" ?> will provide the following services to <strong><?php clientname($id)?></strong> in the following address with agreed payment terms and condition, until the contract is cancelled.
             <!-- para 1 end -->
             <!-- Company Details -->
             <br>
             <br>
<!--              <h6>Office Details</h6> -->
            <?php                 
                ///office details
                  $ofd="SELECT `id`, `office_name`, `office_owner_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$id'";
                  $run_ofd=mysqli_query($conn,$ofd);
                  while ($row_ofd=mysqli_fetch_array($run_ofd))
                  {
                    ?>
                    <p><strong><?php echo $row_ofd['office_name'];?></strong><br>
                    <?php echo $row_ofd['office_owner_name'];?><br>
                    <?php echo $row_ofd['office_address'];?><br>
                    <?php echo "Contact : ".$row_ofd['office_contact_no'];?><br>
                   <?php echo "GST : ".$row_ofd['GstNO'];?><br>
                   <?php echo "Email : ".$row_ofd['Email'];?></p>
                    <?php
                  }
                ?>
              <br>
              <p style=" font-weight: bold;">
                <p>
                  Agreed prices and payment terms :
                </p>
                1 )  Services Details :- 
              </p>
                <div style="padding:2px;">
                  <table  width="80%" style="border: none;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service Name </th>                        
                        <th scope="col">Price </th>
                        <th scope="col">Price Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                        function price($companyid,$servicesid)
                        {
                          require '../config.php';
                          $sql="SELECT  `price` FROM `services_status` WHERE `CompanyID`='$companyid' AND `ServiceId`='$servicesid'";
                          $run=mysqli_query($conn,$sql);
                          while ($row=mysqli_fetch_array($run))
                          {
                            $price=$row['price'];
                          }
                          return $price;
                        }
                      ?>
                      <?php   
                      $for_table = array();
                      $sql_services_id="SELECT `CompanyID`, `ServiceId` FROM `services_status` WHERE `CompanyID`='$id';";
                        $run_service_id=mysqli_query($conn,$sql_services_id);
                        while ($row_d=mysqli_fetch_array($run_service_id))
                        {
                          $s_id=$row_d['ServiceId']; 
                          array_push($for_table,$s_id);
                        }
                         $c=0;
                        foreach ($for_table as $key)
                         {
                           $services_data_select="SELECT `id`, `service_name`, `service_des`, `price_type`,`date` FROM `services` WHERE `id`='$key'";
                          $run_services=mysqli_query($conn,$services_data_select);
                            while ($row_t=mysqli_fetch_array($run_services))
                            {
                              $ser=$row_t['id'];
                                $c=$c+1;
                                ?>
                                <tr>
                                  <td>
                                    <?php echo $c;?>
                                  </td>
                                  <td>
                                    <?php echo $row_t['service_name'];?>
                                  </td>                                  
                                  <td align="center">
                                    <?php echo price($id,$ser);?>
                                  </td>
                                  <td align="center">
                                    <?php echo $row_t['price_type']; ?>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                        
                     ?>
                    </tbody>
                  </table>
                   <br><br>
                   </div>
                   <p>
                     2) Payment will made within 10 days after the invoice received.
                   </p>
                           
           </div>
           <br>
            <div class="text-end">
              <b>For</b>
             <!-- &nbsp; Sign & stamp&nbsp;  &nbsp;  &nbsp;<br> -->
              <strong style="margin-top:25px;"><?php clientname($id)?></strong>
            </div>
         </div>
        <div class="col-1" style=> 
        
        </div>
      </div>
    
    </div>
    <div align="center" style="padding:20px;">
        <button onclick="print_me()">
      Print
    </button>

    </div>
    <script type="text/javascript">
      function print_me()
            {
                var content = document.getElementById('print_content').innerHTML;
                var win = window.open();
                win.document.write(content);
                win.print();
                win.close();
            }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>  
  </body>
</html>
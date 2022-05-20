<?php 
   $page_title="Dashboard";
   $page_icon='<i class="mdi mdi-playlist-check menu-icon"></i>&nbsp;&nbsp';
 

   require 'admin_header.php';
   require 'function_for_office.php';

   $id=user_form_data($username,$password);
   ?>
   <div class="content-wrapper">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
                         <div class="cont p-4" >
                <div class="row">

                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 p-2" >
                    <div class="card">
                      <div class="card-header">
                        <span>
                          Services Info 
                        </span>
                      </div>
                      <div class="card-body">
                        <div class="on-body" style="overflow: auto;">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">sr</th>
                                <th scope="col">Invoice Number </th>
                                <th scope="col">Gst Status </th>
                                <th scope="col">Total Amount</th> 
                                <th scope="col">Paid Amount</th>
                                <th scope="col">Pending Amount </th> 
                                <th scope="col">Genrated Date</th>
                                <th scope="col">view</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tbody>
                  <?php 
                  $sr=0;  
                    $sql_get_data="SELECT `id`,`invoice_number`, `company_id`, `invoice_data`, `total_amount`, `paid_amount`, `gst_status`,DATE(`create_at`) as`date` FROM `sells_invoice_data` WHERE `company_id`='$id' ";
                    $run_get_data=mysqli_query($conn,$sql_get_data);
                    while ($row_get_data=mysqli_fetch_array($run_get_data)) 
                    {
                      $sr=$sr+1;
                      $gst_status=$row_get_data['gst_status'];
                      ?>
                      <tr style="<?php 
                      if($gst_status==1)
                              {
                                echo "color: red;";
                              }
                              else
                              {
                                echo "color: green;";
                              }

                    ?>">
                        <td>
                          <?php echo $sr;?>
                        </td>
                        <td>
                          <?php echo $row_get_data['invoice_number'];?>
                        </td>
                        <td>
                          <?php if($gst_status==1)
                              {
                                echo "YES";
                              }
                              else
                              {
                                echo "NO";
                              }
                          ?>
                        </td>
                        <td>
                          <?php echo $row_get_data['total_amount'];?>
                        </td>
                        <td>
                          <?php echo $row_get_data['paid_amount'];?>
                        </td>
                              <td><?php  echo $row_get_data['total_amount']-$row_get_data['paid_amount']; ?></td>
                        <td>
                          <?php echo $row_get_data['date'];?>
                        </td>
                        <td>
                             <a href="show_sells_invoice.php?id=<?php echo $row_get_data['id'];?>">
                                <button class="btn btn-primary">
                                   <i class="mdi mdi-teamviewer menu-icon" style="font-size:20px;"></i>
                                </button>
                             </a>                                                   
                        </td>
                      </tr>
                      <?php
                    }
                   ?>
                </tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 p-2">
                    <!-- office information start -->
                      <div class="card">
                        <div class="card-header text-center">
                          <span class="text-center">
                            Office Info
                          </span>
                        </div>
                        <div class="card-body">     
                        <div class="on-body" style="overflow: auto;">

                          <?php   
                                                        $sql_for_office_id=
                              $sql_for_office_info="SELECT `id`, `office_name`, `office_owner_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$id'";
                              $run_for_office_info=mysqli_query($conn,$sql_for_office_info);
                              while ($row_sql_office_info=mysqli_fetch_array($run_for_office_info)) 
                                {
                                    $office_id=$row_sql_office_info['id'];
                                  ?>

                          <table class="table">
                            <tbody>
                              <tr>
                                <th>
                                   Office Name 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['office_name']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                   Office Owner Name 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['office_owner_name']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  Office Address 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['office_address']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                   Office Contact NO. 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['office_contact_no']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                   Office GST No. 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['GstNO']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  Office GST NO 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['GstNO']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  Email  
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['Email']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  Office Incharge 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['office_incharge']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  Office Incharge Contact No 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['office_incharge_contact_no']; ?>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                   Register Date 
                                </th>
                                <td>
                                  <?php echo $row_sql_office_info['date']; ?>
                                </td>
                              </tr>
                            </tbody>
                          </table> 
                          <?php
                              }
                           ?>                 
                        </div>                   
                                                  
                        </div>
                      </div>
                      <!-- office information end-->
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 p-2" >
                    <div class="card">
                      <div class="card-header">
                        <span>
                          Services Info 
                        </span>
                      </div>
                      <div class="card-body">
                        <div class="on-body" style="overflow: auto;">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>
                                  Sr.no 
                                </th>
                                <th>
                                  Services
                                </th>
                                <th>
                                  status
                                </th>
                                <th>
                                  start Date
                                </th>
                                <th>
                                  Last Billing Date
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $office_id="";
                                  $sql_check_active_services="SELECT `id`, `CompanyID`, `ServiceId`, `price`, `ServiceStatus`, `ActiveDate`,  `LastBillingDate` FROM `services_status` WHERE `CompanyID` = '$id' AND `ServiceStatus`='on';";
                                  $run_for_check_active_services=mysqli_query($conn,$sql_check_active_services);

                                  $count=mysqli_num_rows($run_for_check_active_services);
                                  if ($count>0)
                                  {
                                    $c=0;
                                    while ($row_for_services=mysqli_fetch_array($run_for_check_active_services)){
                                         $c=$c+1;                            
                                    ?>
                                    <tr>
                                      <td>
                                        <?php echo $c; ?>
                                      </td>
                                      <td>
                                        <?php echo servicesname($row_for_services['ServiceId']);?>
                                      </td>
                                      <td>
                                        <?php echo $row_for_services['ServiceStatus'];?>
                                      </td>
                                      <td>
                                        <?php echo $row_for_services['ActiveDate'];?>
                                      </td>
                                      <td>
                                        <?php echo $row_for_services['LastBillingDate'];?>
                                      </td>                                    
                                    </tr>
                                    <?php
                                  }
                                       }
                                  else
                                  {
                                    ?>
                                    <tr>
                                      <td colspan="5">
                                        NO data Found
                                      </td>
                                    </tr>
                                    <?php
                                  }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
             </div>
         </div>
      </div>
   </div>
    </div>
   <?php
      require 'admin_footer.php';
 ?>
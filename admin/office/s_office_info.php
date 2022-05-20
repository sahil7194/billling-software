<?php 
   $page_title="Office Info";
   $page_icon='<i class="mdi mdi-office menu-icon"></i>&nbsp;&nbsp';
   require '../function_for_office.php';

   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
   	<div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
          <?php   
                        $id=$_GET['id'];
                      
                        $count=0;
                        $sql_for_table_data="SELECT `id`, `office_name`, `office_address`, `office_contact_no`, `office_incharge`, `office_owner_name`,`office_incharge_contact_no`, `GstNo`,`Email`, `date` FROM `office_deatils` WHERE `id`='$id'";
                        
                        $run_select=mysqli_query($conn,$sql_for_table_data);
                        while ($table_row=mysqli_fetch_array($run_select))
                        {
                            $office_name=$table_row['office_name'];
                            $office_owner_name=$table_row['office_owner_name'];
                            $office_address=$table_row['office_address'];
                            $office_contact_no=$table_row['office_contact_no'];
                            $email=$table_row['Email'];
                            $gst_no=check_gst($table_row['id']);
                            $office_incharge=$table_row['office_incharge'];
                            $office_incharge_contact_no=$table_row['office_incharge_contact_no'];
                        }

                       ?>
                      <div class="info-section container-fluid">

                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                               Name :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                            <?php  echo $office_name; ?>
                          </div>
                        </div>
                        <!-- row end-->
                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                              Office Owner Name :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                            <?php  echo $office_owner_name; ?>
                          </div>
                        </div>
                        <!-- row end-->
                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                               Addrees :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                             <?php  echo $office_address; ?>
                          </div>
                        </div>
                        <!-- row end-->

                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                              Contact No :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                             <?php  echo $office_contact_no; ?>
                          </div>
                        </div>
                        <!-- row end-->

                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                              Email :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                             <?php  echo $email; ?>
                          </div>
                        </div>
                        <!-- row end-->

                         <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                              GST NO :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                             <?php  echo $gst_no; ?>
                          </div>
                        </div>
                        <!-- row end-->

                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                              HR Name :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                             <?php  echo $office_incharge; ?>
                          </div>
                        </div>
                        <!-- row end-->

                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                               HR Contact No :- 
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                             <?php  echo $office_incharge_contact_no; ?>
                          </div>
                        </div>
                        <!-- row end-->

                        <!-- row start-->
                        <div class="row">
                          <div class="label col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <label>
                              Active Services
                            </label>
                          </div>
                          <div class="data col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xm-12 col-12">
                            <table class="table table-hover" style="width: 800px;">
                              <tr>
                                <td>
                                  Sr. No.
                                </td>
                                <td>
                                  Services Name  
                                </td>
                                <td>
                                  Activate Date
                                </td>
                                <td>
                                  Deactive Date
                                </td>
                                <td>
                                  Last Billing Date
                                </td>
                              </tr>  
                           
                              <?php 
                    $c=0;

                     $sql_services_data="SELECT `id`, `CompanyID`, `ServiceId`, `price`, `ServiceStatus`, `ActiveDate`, `Deactivate`, `LastBillingDate`, `LastUpDate`, `status`, `update_at` FROM `services_status` WHERE `CompanyID`='$id';";
                      $run_services_data=mysqli_query($conn,$sql_services_data);
                      while ($row_services_data=mysqli_fetch_array($run_services_data))
                      {
                        $c=$c+1;
                        ?>
                          <tr>
                            <td>
                              <?php echo $c;                                
                              ?>                                
                            </td>
                           
                            <td>
                              <?php  echo servicesname($row_services_data['ServiceId']);?>                               
                            </td>
                            <td>
                              <?php echo $row_services_data['ServiceStatus'];?>                               
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
                           
                          </tr>
                        <?php
                      }
                     ?>
                   </table>
                          </div>
                        </div>
                        <!-- row end-->
                      </div>
                  </div>
              </div>
   </div>
   <?php
      require '../admin_footer.php';
 ?>
<?php 
   $page_title="Staff Info";
   $page_icon='<i class="mdi mdi-human-male-female menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
      <div class="grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4>            
            <table class="table table-hover">
                  <?php   
                  $id=$_GET['id'];
                    $select_staff="SELECT `id`, `full_name`, `mobile_no`, `pass_photo`, `current_address`, `current_address_file`, `permanet_address`, `permanet_address_file`, `addhar_card_no`, `addhar_card_file`, `pan_card_no`, `pan_card_file`, `date`,`salary_amunt` FROM `staff` WHERE `id`='$id'";
                    $run=mysqli_query($conn,$select_staff);
                    while ($row_staff=mysqli_fetch_array($run))
                    {
                    ?>
                   <tr>
                     <th class="col-lg-3">
                       Full Name
                     </th>
                     <td class="col-lg-7">
                       <?php echo $row_staff['full_name'];?>
                     </td>
                     <td class="col-lg-2" rowspan="3" class="text-center">
                        
                         <!-- model start-->
                          <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal7">
                            <!--<span class="material-icons">visibility</span>-->
                            <img src="<?php echo $row_staff['pass_photo'];?>" height="100px" width="130px">
                          </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Current Address Document </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <img src="<?php echo $row_staff['pass_photo'];?>" height="150px" width="200px">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                     </td>
                   </tr>
                   <tr>
                     <td >
                       
                     </td>
                     <td>
                       
                     </td>
                    </tr>
                    <tr>
                     <th >
                       Mobile No.
                     </th>
                     <td>
                       <?php echo $row_staff['mobile_no'];?>
                     </td>
                    </tr>
                    <tr>
                     <th >
                       Current Address
                     </th>
                     <td>
                      <?php echo $row_staff['current_address'];?>
                     </td>
                     <td class="text-center">
                      <!-- model start-->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                            <span class="material-icons">visibility</span>
                          </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Current Address Document </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                              <img src="<?php echo $row_staff['current_address_file'];?>" height="150px" width="200px">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                      &nbsp;
                      <a href="<?php echo $row_staff['current_address_file'];?>">
                        <button class="btn btn-primary">
                          <span class="material-icons">download_for_offline</span>
                        </button>
                      </a>
                     </td>
                    </tr>
                    <tr>
                     <th>
                       Permanent Address
                     </th>
                     <td>
                       <?php echo $row_staff['permanet_address'];?>
                     </td>
                     <td class="text-center">
                      <!-- model start-->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                            <span class="material-icons">visibility</span>
                          </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Permanent Address Document</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                              <img src="<?php echo $row_staff['permanet_address_file'];?>" height="150px" width="200px">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                      &nbsp;
                      <a href="<?php echo $row_staff['permanet_address_file'];?>">
                        <button class="btn btn-primary">
                          <span class="material-icons">download_for_offline</span>
                        </button>                        
                      </a>
                     </td>
                    </tr>
                    <tr>
                     <th>
                       Addhar Card
                     </th>
                     <td>
                       <?php echo $row_staff['addhar_card_no'];?>
                     </td>
                     <td class="text-center">
                      <!-- model start-->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
                            <span class="material-icons">visibility</span>
                          </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Addhar Card</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                              <img src="<?php echo $row_staff['addhar_card_file'];?>" height="150px" width="200px">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                      &nbsp;
                      <a href="<?php echo  $row_staff['addhar_card_file'];?>">
                        <button class="btn btn-primary">
                          <span class="material-icons">download_for_offline</span>
                        </button>                        
                      </a>
                     </td>
                    </tr>
                    <tr>
                     <th>
                       Pan Card
                     </th>
                     <td>
                       <?php echo $row_staff['pan_card_no'];?>
                     </td>
                     <td class="text-center">                      
                      <!-- model start-->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5">
                            <span class="material-icons">visibility</span>
                          </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Pan Card</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                              <img src="<?php echo $row_staff['pan_card_file'];?>" height="150px" width="200px">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                      &nbsp;
                      <a href="<?php echo $row_staff['pan_card_file'];?>">
                        <button class="btn btn-primary">
                          <span class="material-icons">download_for_offline</span>
                        </button>
                      </a>
                     </td>
                    </tr>
                    <tr>
                      <th>
                        Salary Amount
                      </th>
                      <td>
                        <?php echo $row_staff['salary_amunt'];?>
                      </td>
                    </tr>     
                    <tr>
                      <td>
                         <a href="print_staff_info.php?id=<?php echo $row_staff['id'];?>">
                            <button class="btn btn-primary">
                            print
                          </button>
                          </a>

                      </td>
                    </tr>              
                  </table>

                                   <?php
                }
              ?>
              
                        </div>
        </div>
      </div>
   </div>
   <?php
      require '../admin_footer.php';
 ?>
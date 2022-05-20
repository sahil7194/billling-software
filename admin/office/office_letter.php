<?php 
   $page_title="Office Letter";
   $page_icon='<i class="mdi mdi-office menu-icon"></i>&nbsp;&nbsp';

   require '../admin_header.php';
   require '../function_for_office.php';
   ?>
   <div class="content-wrapper">
      <div class="grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4>            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>          
                  <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Office Name</th>
                    <th scope="col">Office Contact No</th>
                    <th scope="col">Register Date</th>
                    <th scope="col">Print</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="office_data">
                      <?php   
                        
                        $count=0;
                        $sql_for_table_data="SELECT `id`, `office_name`, `office_address`, `office_contact_no`, `office_incharge`, `office_incharge_contact_no`, DATE(`date`)as `date`,`GstNo`,`code` FROM `office_deatils` WHERE `status`='0' ORDER BY `code` ASC";
                        
                        $run_select=mysqli_query($conn,$sql_for_table_data);
                        while ($table_row=mysqli_fetch_array($run_select))
                          {
                            $count=$count+1;

                        $o_date=$table_row['date'];

                        $timestamp = strtotime($o_date);
 
                        // Creating new date format from that timestamp
                        $new_date = date("d-m-Y", $timestamp);
                            ?>                        
                          <tr
                            style="
                          <?php
                            if (check_gst($table_row['id'])) 
                            {
                              echo "color:green;";
                            }
                            else
                            {
                              echo "color:red;";
                            }
                          ?>
                          "
                          >
                            <td><?php echo $table_row['code']?></td>
                            <td><?php echo $table_row['office_name']?></td>
                            <td><?php echo $table_row['office_contact_no']; ?></td>
                            <td><?php echo $new_date; ?></td>
                            <td >
                              <a href="./offer_letter_print.php?id=<?php echo $table_row['id'];?>">
                                <span class="material-icons">print</span>
                              </a>
                            </td>
                            <td align="center">
                              <a href="./offer_letter_upload.php?id=<?php echo $table_row['id'];?>">
                                <span class="material-icons">cloud_upload</span>
                              </a>
                              
                            </td>
                            <td align="center">                              
                              <a href="./offer_letter_preview.php?id=<?php echo $table_row['id'];?>">
                                <span class="material-icons">preview</span>
                              </a>
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
   <?php
      require '../admin_footer.php';
 ?>
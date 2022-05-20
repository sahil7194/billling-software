<?php 
   $page_title="Active Services Status";
   $page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';
   require '../function_for_office.php';
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
      <div class="content-wrapper">
      <div class="grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4>            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>          
                  <tr>
                     <th scope="col">#</th>
                     <th>Code </th>
                    <th scope="col">Office Name</th>
                    <th scope="col">Details</th>
                  </tr>
                </thead>
                <tbody id="services_data">
                      <?php   
                        $c="0";
                        $s_i="SELECT DISTINCT a.code, a.office_name,a.id FROM office_deatils a INNER JOIN services_status b ON a.id = b.`CompanyID` ORDER BY a.code ";
                        $r=mysqli_query($conn,$s_i);
                        while($row_c=mysqli_fetch_array($r))
                        {
                          $id=$row_c['id'];
                          $c=$c+1;
                        ?>

                        <?php
                            if (check_gst($id)) 
                            {
                              $color="color:green;";
                            }
                            else
                            {
                              $color="color:red;";
                            }
                          ?>
                    <tr style="<?php echo $color;?>">
                      <td>
                        <?php echo $c; ?>
                      </td>
                      <td style="color: black;">
                          <a href="./details_services.php?id=<?php echo $id; ?>" style="<?php echo $color;?>">
                            <?php echo $row_c['code'];; ?>                                                    
                        </a>
                      </td>
                      <td style="color: black;">
                          <a href="./details_services.php?id=<?php echo $id; ?>" style="<?php echo $color;?>">
                            <?php echo $row_c['office_name'];; ?>                                                    
                        </a>
                      </td>
                      <td>
                        <a href="./details_services.php?id=<?php echo $id; ?>">
                            <span class="material-icons">info</span>
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
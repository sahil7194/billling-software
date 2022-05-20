<?php 
   $page_title="Order Summary";
   $page_icon='<i class="mdi mdi-playlist-check menu-icon"></i>&nbsp;&nbsp';
	
  require 'function_for_office.php';

   require 'admin_header.php';
   
   ?>
	<div class="content-wrapper">

    
	      <div class="col-12 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
              <?php  $id=user_form_data($username,$password); ?>
	            <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">
                        Sr.No
                      </th>
                      <th>
                        Services Name
                      </th>
                      <th>
                        Qunaity
                      </th>                      
                      <th>
                        Done By
                      </th>
                      <th>
                       Date 
                        <small>                             
                           (YYYY/MM/DD )
                        </small>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		

                        $a=0;  
                          $sql_for_entry_by_unit="SELECT `Id`, `Office_id`, `SeerviceId`, `Quantity`, `Date`, `doneby`,`time` FROM `dailystatusforunit` WHERE `Office_id`='$id' ORDER BY `Date` DESC";
                          $run_for_entry_by_unit=mysqli_query($conn,$sql_for_entry_by_unit);
                          $count_row_for_entery_by_unit=mysqli_num_rows($run_for_entry_by_unit);

                          if ($count_row_for_entery_by_unit>0)
                          {
                            while ($row_for_entery_by_unit=mysqli_fetch_array($run_for_entry_by_unit))
                            {
                              $a=$a+1;
                              ?>
                              <tr>
                                <td>
                                  <?php echo $a; ?>
                                </td>
                                <td>
                                  <?php echo servicesname($row_for_entery_by_unit['SeerviceId']); ?>
                                </td>
                                <td>
                                  <?php echo $row_for_entery_by_unit['Quantity']; ?>
                                </td>
                                <td>
                                  <?php echo $row_for_entery_by_unit['doneby']; ?>
                                </td>
                                <td>
                                  <?php echo $row_for_entery_by_unit['Date']." ".$row_for_entery_by_unit['time']; ?>
                                </td>
                              </tr>
                              <?php
                            }
                          }
                          else
                          {
                            ?>
                            <tr>
                              <td colspan="6" align="center">
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
   <?php
      require 'admin_footer.php';
 ?>
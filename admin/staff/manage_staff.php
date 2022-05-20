<?php 
error_reporting('0');
   $page_title="Manage Staff";
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
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>          
                  <tr>
                     <th scope="col"># </th> 
                     <th scope="col">Name </th> 
                     <th scope="col">Contact NO  </th>
                     <th scope="col">Register Date  </th>
                     <th scope="col">Details</th>  
                     <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="staff_data">
                      <?php   
                        
                        $count=0;
                        $sql_for_table_data="SELECT `id`,`full_name`,`date`, Date(`date`)as 'n_date',`mobile_no`,DATE(`date`) as `date` FROM `staff` WHERE `status`='0'";
                        
                        $run_select=mysqli_query($conn,$sql_for_table_data);
                        if (mysqli_num_rows($run_select)) 
                        {
                          
                        }
                        else
                        {
                          ?>
                          <tr>
                            <td colspan="6" align="center">
                              No Data Found
                            </td>
                          </tr>
                          <?php
                        }
                        while ($table_row=mysqli_fetch_array($run_select))
                          {
                            $count=$count+1;
                            $date=$table_row[`date`];

                            $o_date=$table_row['date'];

                            $timestamp = strtotime($o_date);
     
                            // Creating new date format from that timestamp
                            $new_date = date("d-m-Y", $timestamp);
                            ?>                        
                          <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $table_row['full_name']; ?></td>
                            <td><?php echo $table_row['mobile_no']; ?></td>
                            <td><?php echo $new_date." ".date("g:ia", strtotime($date));?></td>
                            <td>
                              
                                <a href="./staff_info.php?id=<?php echo $table_row['id']; ?>">
                                  <span class="material-icons">info</span> 
                                </a>                         
                            </td>
                            <td>
                              <a href="./edit_staff.php?id=<?php echo $table_row['id']; ?>">
                                <span class="material-icons">edit</span>
                              </a>
                            </td>
                            <td>
                              <button class="btn btn-danger delete" value="?php echo $table_row['id']; ?>">
                                <span class="material-icons">delete</span>
                              </button>
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
    <script type="text/javascript">
     $(document).ready(function(){
        $('.delete').on('click',function(){
            let val =$(this).val();

            let text = "Are you sure.";
            link='delete_staff.php?id='+val;
            if (confirm(text) == true) {
              window.location.replace(link);
              } else {
              text = "You canceled!";
            }
            //console.log(link);
        });
     });
   </script>
   <?php
      require '../admin_footer.php';
 ?>
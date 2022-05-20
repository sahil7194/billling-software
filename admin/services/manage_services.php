<?php 
   $page_title="Manage Services";
   $page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';

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
                     <th scope="col">#</th>
                     <th scope="col">HSN/SAC </th>
                     <th scope="col">Services Name </th> 
                     <th scope="col">Service Details</th>   
                     <th scope="col">Price Type  </th>
                     <th scope="col">Added Date </th> 
                     <th scope="col">Action  </th>                 
                  </tr>
                </thead>
                <tbody id="services_data">
                      <?php   
                        
                        $count=0;
                        $sql_for_table_data="SELECT `id`, `service_name`, `service_des`, `price_type`, DATE(`date`) as `date`,`HSN`FROM `services` WHERE `status`='0'";
                        
                        $run_select=mysqli_query($conn,$sql_for_table_data);
                        while ($table_row=mysqli_fetch_array($run_select))
                          {
                            $count=$count+1;
                            $o_date=$table_row['date'];

                        $timestamp = strtotime($o_date);
 
                        // Creating new date format from that timestamp
                        $new_date = date("d-m-Y", $timestamp);
                            ?>                        
                          <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $table_row['HSN']; ?></td>
                            <td><?php echo $table_row['service_name']; ?></td>
                            <td><?php echo $table_row['service_des']; ?></td>
                            <td><?php echo $table_row['price_type']; ?></td>
                            
                            <td><?php echo $new_date; ?></td>
                            <td>
                              <a href="./edit_service.php?id=<?php echo $table_row['id']; ?>">
                                <span class="material-icons">edit</span>
                              </a>
                            </td>
                            <td>
                              <button class="btn btn-danger delete" value="<?php echo $table_row['id']; ?>">
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
            link='delete_service.php?id='+val;
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
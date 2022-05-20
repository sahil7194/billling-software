<?php 
   $page_title="Manage User";
   $page_icon='<i class="mdi mdi-account-plus menu-icon"></i>&nbsp;&nbsp';
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
                        <th scope="col">Username </th>
                        <th scope="col">Password </th>
                        <th scope="col">Profile</th>  
                     <!--    <th scope="col">userform</th>  -->
                        <th>Services Type</th>
                        <th scope="col">Active Status</th>  
                        <th scope="col">Date </th> 
                        <th scope="col">Action </th>

                     </tr>
                   </thead>
                   <tbody id="user_data">
                      <?php   
                        $count=0;
                        $sql_for_table_data="SELECT `id`, `username`, `password`, `profile`, `user_form`, `ActiveStatus`, `date` ,`services_type` FROM `user` WHERE `status`='0' ORDER BY `date` DESC";
                        
                        $run_select=mysqli_query($conn,$sql_for_table_data);
                        while ($table_row=mysqli_fetch_array($run_select))
                          {
                            $count=$count+1;
                            ?>                        
                          <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $admin_dont=$table_row['username']; ?></td>
                            <td><?php echo $table_row['password']; ?></td>
                            <td><?php echo $table_row['profile']; ?></td>
                            <!-- <td><?php //echo $table_row['user_form']; ?></td> -->
                             <td><?php echo $table_row['services_type']; ?></td>
                            <td><?php echo $table_row['ActiveStatus']; ?></td>
                            <td><?php echo $table_row['date']; ?></td>
                           
                            <td>
                              <a href="./user_edit.php?id=<?php echo $table_row['id']; ?>">
                                <span class="material-icons">edit</span>
                              </a>
                            </td>
                            <td>
                              <?php 
                                if ($admin_dont=='admin')
                                {

                                }
                                else
                                {
                                  ?>
                                  <button class="btn btn-danger delete" value="<?php echo $table_row['id']; ?>">
                                    <span class="material-icons">delete</span>
                                  </button>
                                  <?php
                                }
                               ?>
                              
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
            link='user_delete.php?id='+val;
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
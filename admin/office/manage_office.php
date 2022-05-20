<?php 
   $page_title="Manage Office";
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
                    <th scope="col">Office Owner Name</th>
                    <th scope="col">Office Contact No</th>
                    <th scope="col">Register Date</th>
                    <th scope="col">Details</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      $sql_for_office_data="SELECT `id`, `office_name`, `office_owner_name`, DATE(`date`) as `date`,`office_contact_no`, `code`FROM `office_deatils` WHERE `status`='0' ORDER BY `code` ASC";
                      $run_for_office_data=mysqli_query($conn,$sql_for_office_data);
                      while ($row_for_office_data=mysqli_fetch_array($run_for_office_data))
                      {

                        $o_date=$row_for_office_data['date'];

                        $timestamp = strtotime($o_date);
 
                        // Creating new date format from that timestamp
                        $new_date = date("d-m-Y", $timestamp);
                        ?>
                          <tr style="
                          <?php
                            if (check_gst($row_for_office_data['id'])) 
                            {
                              echo "color:green;";
                            }
                            else
                            {
                              echo "color:red;";
                            }
                          ?>

                          ">
                          <td>
                              <?php echo $row_for_office_data['code'] ?>
                            </td>
                            <td>
                              <?php echo $row_for_office_data['office_name'];
                                echo "<br>";
                                //echo check_gst($row_for_office_data['id']);
                              ?>

                            </td>
                            <td>
                              <?php echo $row_for_office_data['office_owner_name'] ?>
                            </td>
                            <td>
                              <?php echo $row_for_office_data['office_contact_no'] ?>
                            </td>

                            <td>
                              <?php echo $new_date;?>
                            </td>
                             <td>
                              <a href="./s_office_info.php?id=<?php echo $row_for_office_data['id']; ?>">
                              <span class="material-icons">info</span>
                              </a>
                            </td>
                            <td>
                              <a href="./edit_office.php?id=<?php echo $row_for_office_data['id']; ?>">
                                <span class="material-icons">edit</span>
                              </a>
                                </td>
                                <td>
                              <button class="delete btn btn-danger" value="<?php echo $row_for_office_data['id']; ?>">
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
            link='delete_office.php?id='+val;
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
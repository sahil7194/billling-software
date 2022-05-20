<?php 
   $page_title="Office Info";
   $page_icon='<i class="mdi mdi-office menu-icon"></i>&nbsp;&nbsp';
  function companyname($companyid)
  {
    require '../config.php';

    $select="SELECT `office_name` FROM `office_deatils` WHERE `id`='$companyid'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      $name=$row['office_name'];
    }

    return $name;
  }
  function servicesname($servicesid)
  {
    require '../config.php';

    $select="SELECT `service_name` FROM `services` WHERE `id`='$servicesid'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      $name=$row['service_name'];
    }

    return $name;
  }
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
   	<div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
          <table class="table table-hover ">
                  <thead>
                    <tr>
                      <td class="col-1">
                        Sr. No.
                      </td>
                      <td>
                        Name 
                      </td>
                      <td class="col-2">
                        view
                      </td>
                      <td>
                        Upload Date
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id=$_GET['id'];
                       $sql_for_show_file_data="SELECT `id`, `office_id`, `file_url`, `date` FROM `aggrement_files` WHERE `office_id`=$id";
                       $run_for_show_file_data=mysqli_query($conn,$sql_for_show_file_data);
                       $c=0;
                       while ($row_file_data=mysqli_fetch_array($run_for_show_file_data))
                       {
                        $c=$c+1;
                         ?>
                          <tr>
                            <td>
                              <?php echo $c;?>
                            </td>
                            <td>
                              <?php
                                echo ltrim($row_file_data['file_url'],"aggremeent/");
                              ?>
                            </td>
                            <td>
                              <a target="_blank" href="<?php echo "".$row_file_data['file_url'];?>">
                                <span class="material-icons">visibility</span>
                              </a>
                            </td>
                            <td>
                              <?php echo $row_file_data['date'];?>
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
      require '../admin_footer.php';
 ?>
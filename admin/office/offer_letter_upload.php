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
          	 <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xm-12 col-12 mt-3">
                      <label for="exampleFormControlInput1" style="font-size: 16px; font-weight:bold;">
                      Select Office Letter
                    </label>
                      <input type="file" class="form-control" name="offer" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                     <div class="right col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xm-12 col-12" style="width:100%; text-align: right; padding-right: 40px;"> 
                        <input type="reset" name="reset" value="Reset" class="btn">
                        &nbsp;&nbsp;

                        <input type="submit" name="upload" value="Upload" class="btn">
                      </div>
                </form>
                <?php   
                  if (isset($_POST['upload']))
                  {
                    $office_id=$_GET['id'];
                    $location="../doc/";

                    $file=$_FILES['offer'];

                    $url_for_upload=$location.basename($file['name']);
                    //1048576 less than 1 mb
                    if ($file['size']<=1048576)
                    {                      
                    
                      if (move_uploaded_file($file['tmp_name'], $url_for_upload))
                      {
                        $sql_for_file_uplaod="INSERT INTO `aggrement_files`(`office_id`, `file_url`) VALUES ('$office_id','$url_for_upload');";
                        $run_for_file_uplaod=mysqli_query($conn,$sql_for_file_uplaod);
                        if ($run_for_file_uplaod==true)
                        {
                          echo '<script>swal("", "File upload Successfully ", "success")</script>';
                        }
                        else
                        {
                          echo '<script>swal("", "Fail to upload file !", "error")</script>';
                        }
                        
                      }
                      else
                      {
                        echo '<script>swal("", "Fail to upload file !", "error")</script>';
                      }
                    }
                   else
                    {
                      echo '<script>swal("To Large file ", "Upload file less than 1 MB !", "error")</script>';
                    }
                  }
                 ?>
          </div>
        </div>
  	 </div>
	</div>
   <?php
      require '../admin_footer.php';
 ?>
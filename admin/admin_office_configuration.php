<?php 
   $page_title="Configuration";
   $page_icon='<i class="mdi mdi-ticket-confirmation menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require 'admin_header.php';
   if($company_name!="")
   {
      $c_name=$company_name;
   }
   else
   {
      $c_name="";
   }

   if($company_address!="")
   {
      $c_add=$company_address;
   }
   else
   {
      $c_add="";
   }

   if($company_contact_no!="")
   {
      $c_con=$company_contact_no;
   }
   else
   {
      $c_con="";
   }

   if($gst_no!="")
   {
      $c_gst=$gst_no;
   }
   else
   {
      $c_gst="";
   }

   if($company_logo!="")
   {
      $c_logo=$company_logo;
   }
   else
   {
      $c_logo="";
   }

   
   if($bank_name!="")
   {
      $c_bank_name=$bank_name;
   }
   else
   {
      $c_bank_name="";
   }


if($a_c!="")
   {
      $c_a_c=$a_c;
   }
   else
   {
      $c_a_c="";
   }

if($branch!="")
   {
      $c_branch=$branch;
   }
   else
   {
      $c_branch="";
   }

if($ifsc!="")
   {
      $c_ifsc=$ifsc;
   }
   else
   {
      $c_ifsc="";
   }
   ?>
   <div class="content-wrapper">
     <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="client_name">Client Name</label>
                <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Client Name" value="<?php echo $c_name;?>">
              </div>
              <div class="form-group">
                <label for="address">Client Address</label>
                <textarea class="form-control" id="address" name="address" rows="4" placeholder="<?php echo $c_add?>"></textarea>
              </div>
              <div class="form-group">
                <label for="client_contact_no">Client Contact No</label>
                <input type="text" class="form-control" id="client_contact_no" name="client_contact_no" placeholder="Client Contact No" value="<?php echo $c_con;?>">
              </div>                    
              <div class="form-group">
                <label for="gst_no">Client GST NO</label>
                <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="Client GST NO" value="<?php echo $c_gst;?>">
              </div>
              <div class="form-group">
                <img src="<?php echo $c_logo;?>">
                <label for="client_logo">Client Logo</label>
                <input type="file" class="form-control" id="client_logo" name="client_logo" placeholder="Client Logo">
              </div>

              <div class="form-group">
                <label for="bank_name">Bank Name</label>
                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="<?php echo $c_bank_name;?>">
              </div>

              <div class="form-group">
                <label for="a_c">A/C</label>
                <input type="text" class="form-control" id="a_c" name="a_c" placeholder="A/C" value="<?php echo $c_a_c;?>">
              </div>

              <div class="form-group">
                <label for="branch">Branch</label>
                <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch" value="<?php echo $c_branch;?>">
              </div>

              <div class="form-group">
                <label for="ifsc">IFS Code</label>
                <input type="text" class="form-control" id="ifsc" name="ifsc" placeholder="IFS Code" value="<?php echo $c_ifsc;?>">
              </div>
   
              <?php   
                if($c_name!="")
                {
                  ?>
                  <button type="submit" name="edit" class="btn btn-info mr-2">Edit</button>
                  <?php
                }
                else
                {
                  ?>
                  <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                  <?php
                }
               ?>               
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
   </div>
<?php
  require 'admin_footer.php';

  if (isset($_POST['submit']))
  {
      $target_location="doc/";                            
      $client_name=$_POST['client_name'];
      $clinet_address=$_POST['address'];
      $client_contact_no=$_POST['client_contact_no'];
      $gst_no=$_POST['gst_no'];
      $client_logo=$_FILES['client_logo'];
      $bank_name=$_POST['bank_name'];
      $a_c=$_POST['a_c'];
      $branch=$_POST['branch'];
      $ifsc=$_POST['ifsc'];
      $base_name=$target_location.basename($_FILES['client_logo']['name']);
      if ($client_name!="")
      { 

          if (move_uploaded_file($_FILES['client_logo']['tmp_name'], $base_name)) 
        {
          $sql_for_insert="INSERT INTO `configuration`(`client_name`, `address`, `client_contact_no`, `gst_no`, `client_logo`,`bank_name`,`a_c`,`branch`,`ifsc`) VALUES ('$client_name','$clinet_address','$client_contact_no','$gst_no','$base_name','$bank_name','$a_c','$branch','$ifsc')";
         
          if ($run == true) 
          {
            echo "<script>alert('Successfully Configured');</script>";
            unset($_POST['client_name']);
            unset($_POST['address']);
            unset($_POST['client_contact_no']);
            unset($_POST['gst_no']);
            unset($_FILES['client_logo']);
          }
          else
          {
             
          }          
          
        }
        else
        {
          
        }

        $sql_for_insert="INSERT INTO `configuration`(`client_name`, `address`, `client_contact_no`, `gst_no`,`bank_name`,`a_c`,`branch`,`ifsc`) VALUES ('$client_name','$clinet_address','$client_contact_no','$gst_no','$bank_name','$a_c','$branch','$ifsc')";
         $run=mysqli_query($conn,$sql_for_insert);
         echo "<script>alert('Successfully Configured');</script>";
      }
      else
      {
         echo "<script>alert('Client Name Feild must');</script>";
      }

  }


  ///for edit

  if (isset($_POST['edit']))
  {
      $target_location="doc/";                            
      $client_name=$_POST['client_name'];
      $clinet_address=$_POST['address'];
      $client_contact_no=$_POST['client_contact_no'];
      $gst_no=$_POST['gst_no'];
      $client_logo=$_FILES['client_logo'];
      $base_name=$target_location.basename($_FILES['client_logo']['name']);
      $bank_name=$_POST['bank_name'];
      $a_c=$_POST['a_c'];
      $branch=$_POST['branch'];
      $ifsc=$_POST['ifsc'];

      $u_client_name;
      $u_clinet_address;
      $u_client_contact_no;
      $u_gst_no;
      $u_base_name;
      $u_bank_name;
      $u_a_c;
      $u_branch;
      $u_ifsc;


      if($client_name!="")
      {
        $u_client_name=$client_name;
      }
      else
      {
        $u_client_name=$c_name;
      }
      if($clinet_address!="")
      {
        $u_clinet_address=$clinet_address;
      }
      else
      {
        $u_clinet_address=$c_add;
      }


      if($client_contact_no!="")
      {
        $u_client_contact_no=$client_contact_no;
      }
      else
      {
        $u_client_contact_no=$c_con;
      }
      if($gst_no!="")
      {
        $u_gst_no=$gst_no;
      }
      else
      {
        $u_gst_no=$c_gst;
      }
      if($base_name!="")
      {
        move_uploaded_file($_FILES['client_logo']['tmp_name'], $base_name);
        $u_base_name=$base_name;
      }
      else
      {
        $u_base_name=$c_logo;
      }
      if($bank_name!="")
      {
        $u_bank_name=$bank_name;
      }
      else
      {
        $u_bank_name=$c_bank_name;
      }
      if($a_c!="")
      {
        $u_a_c=$a_c;
      }
      else
      {
        $u_a_c=$c_a_c;
      }
      if($branch!="")
      {
        $u_branch=$branch;
      }
      else
      {
        $u_branch=$c_branch;
      }
      if($ifsc!="")
      {
        $u_ifsc=$ifsc;
      }
      else
      {
        $u_ifsc=$c_ifsc;
      }

      $sql_update="UPDATE `configuration` SET `client_name`='$u_client_name',`address`='$u_clinet_address',`client_contact_no`='$u_client_contact_no',`gst_no`='$u_gst_no',`client_logo`='$u_base_name',`bank_name`='$u_bank_name',`a_c`='$u_a_c',`branch`='$u_branch',`ifsc`='$u_ifsc' WHERE `client_contact_no`='$c_con' AND `gst_no`='$c_gst';";
      $run_update=mysqli_query($conn,$sql_update);
      if ($run_update==true) 
      {
        echo "<script>alert('Update Successfully');</script>";
      }
      else
      {
        echo "<script>alert('Fail to Update');</script>";
      }
  }
 ?>
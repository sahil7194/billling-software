<?php 
   $page_title="Edit Office";
   $page_icon='<i class="mdi mdi-office menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
   <?php   
     $id=$_GET['id'];
       //for old values 
       
        $count=0;
        $sql_for_table_data="SELECT `id`, `office_name`, `office_address`, `office_owner_name`,`office_contact_no`, `office_incharge`, `office_incharge_contact_no`, `Email`,`GstNo`,`date`,`code` FROM `office_deatils` WHERE `id`='$id'";
        
        $run_select=mysqli_query($conn,$sql_for_table_data);
        while ($table_row=mysqli_fetch_array($run_select))
          {
            $office_name_old=$table_row['office_name']; 
            $office_addres_old=$table_row['office_address']; 
            $office_owner_name_old=$table_row['office_owner_name'];
            $email_old=$table_row['Email'];
            $gst_no_old=$table_row['GstNo'];
           	$office_contact_no_old=$table_row['office_contact_no']; 
          	$office_office_incharge_old=$table_row['office_incharge']; 
            $office_office_incharge_contact_no_old=$table_row['office_incharge_contact_no'];   
            $old_code=$table_row['code'];                
        }
    ?>
<div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">
              <div class="form-group">
                <label for="office_name">Office Name</label>
                <input type="text" class="form-control" id="office_name" name="office_name" placeholder="<?php echo $office_name_old;?>" value="<?php echo $office_name_old; ?>">
              </div>
              <div class="form-group">
                <label for="office_owner_name">Office Owner Name</label>
                <input type="text" class="form-control" id="office_owner_name" name="office_owner_name" placeholder="<?php echo $office_owner_name_old;?>" value="<?php echo $office_owner_name_old;?>" >
              </div>
              <div class="form-group">
                <label for="office_address">Office Address</label>
                <textarea class="form-control" id="office_address" name="office_address" rows="4" placeholder="<?php echo $office_addres_old;?>"></textarea>
              </div>
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="office_contact_no">Office Contact No</label>
                        <input type="tel" class="form-control" id="office_contact_no" name="office_contact_no" placeholder="<?php echo $office_contact_no_old;?>" value="<?php echo $office_contact_no_old;?>">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $email_old;?>" value="<?php echo $email_old;?>">
                     </div>
                 </div>

              </div>                                 
              <div class="form-group">
                <label for="gst_no">Office GST NO</label>
                <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="<?php echo $gst_no_old;?>" value="<?php echo $gst_no_old;?>">
              </div>
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="office_incharge">Office HR</label>
                        <input type="text" class="form-control" id="office_incharge" name="office_incharge" placeholder="<?php echo $office_office_incharge_old;?>" value="<?php echo $office_office_incharge_old;?>">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="office_incharge_contact_no">Office Incharge Contact No</label>
                        <input type="text" class="form-control" name="office_incharge_contact_no" id="office_incharge_contact_no" placeholder="<?php echo $office_office_incharge_contact_no_old;?>" value="<?php echo $office_office_incharge_contact_no_old;?>">
                     </div>
                 </div>

              </div>
                  <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="code" value="<?php echo $old_code;?>">
                 </div>
    
              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div>
   <?php
      require '../admin_footer.php';

      $id=$_GET['id'];
  	if (isset($_POST['submit']))
  	{
  		$new_office_name=$_POST['office_name'];
  		$new_office_owner_name=$_POST['office_owner_name'];
  		$new_office_address=$_POST['office_address'];
  		$new_office_contact_no=$_POST['office_contact_no'];
  		$new_office_email=$_POST['email'];
  		$new_gst_no=$_POST['gst_no'];
  		$new_office_incharge=$_POST['office_incharge'];
  		$new_office_incharge_contact_no=$_POST['office_incharge_contact_no'];
        $new_code=$_POST['code'];

  		$add="";
  		if ($new_office_address=="")
  		 {
  			$add=$office_addres_old;
  		}
  		else
  		{
  			$add=$new_office_address;
  		}
  		$sql_for_update="UPDATE `office_deatils` SET `office_name`='$new_office_name',`office_address`='$add',`office_contact_no`='$new_office_contact_no',`office_incharge`='$new_office_incharge',`office_incharge_contact_no`='$new_office_incharge_contact_no',`office_owner_name`='$new_office_owner_name',`Email`='$new_office_email',`GstNo`='$new_gst_no',`code`='$new_code' WHERE `id`='$id'";
  		$run_update=mysqli_query($conn,$sql_for_update);
  		if ($run_update=true)
  		{
  			echo '<script>swal("", "Office Updated Succesfully!", "success")</script>';

  		}
  		else
  		{
  			echo '<script>swal("", "ail to update office info !", "error")</script>';
  			
  		}
  	}
 ?>
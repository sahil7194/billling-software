<?php 
   $page_title="Edit Staff";
  $page_icon='<i class="mdi mdi-human-male-female menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
      <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            <?php 
            	$id=$_GET['id'];
                $select_staff="SELECT `id`, `full_name`, `mobile_no`, `pass_photo`, `current_address`, `current_address_file`, `permanet_address`, `permanet_address_file`, `addhar_card_no`, `addhar_card_file`, `pan_card_no`, `pan_card_file`, `date`,`salary_amunt` FROM `staff` WHERE `id`='$id'";
                $run=mysqli_query($conn,$select_staff);
                while ($row_staff=mysqli_fetch_array($run))
                {
                	$old_first_name=$row_staff['full_name'];
					$old_salary_amount=$row_staff['salary_amunt'];
					$old_mobile_no=$row_staff['mobile_no'];                        
					$old_pass_photo=$row_staff['pass_photo'];
					$old_current_address=$row_staff['current_address'];
					$old_current_address_file=$row_staff['current_address_file'];
					$old_permanet_address=$row_staff['permanet_address'];                         
					$old_permanet_address_file=$row_staff['permanet_address_file'];                     
					$old_addhar_card_no=$row_staff['addhar_card_no'];                        
					$old_addhar_card_file=$row_staff['addhar_card_file'];
					$old_pan_card_no=$row_staff['pan_card_no'];
				    $old_pan_card_file=$row_staff['pan_card_file'];
                }
               ?>
            <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="<?php echo $old_first_name;?>" value="<?php echo $old_first_name;?>">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="mobile_no">Mobile No.</label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="<?php echo $old_mobile_no;?>" value="<?php echo $old_mobile_no;?>">
                     </div>
                 </div>

              </div>

              <div class="form-group">
                  <label for="pass_photo">Photo</label>
                  <input type="file" class="form-control" id="pass_photo" name="pass_photo" placeholder="Mobile No.">
               </div>
               	<div class="img">
               		<img src="<?php echo $old_pass_photo;?>" height="200px" width="200px">
               	</div>
                <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                         <label for="current_address">Current Address</label>
                         <textarea class="form-control" id="current_address" name="current_address" rows="4" placeholder="<?php echo $old_current_address;?>"></textarea>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="current_address_file">Current Address Document</label>
                        <input type="file" class="form-control" id="current_address_file" name="current_address_file" placeholder="Current Address Document">
                     </div>
                     <div class="img">
	               		<img src="<?php echo $old_current_address_file;?>" height="200px" width="200px">
	               	</div>
                 </div>

              </div>
              	

              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                         <label for="permanet_address">Permanent Address</label>
                         <textarea class="form-control" id="permanet_address" name="permanet_address" rows="4" placeholder="<?php echo $old_permanet_address;?>"></textarea>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="permanet_address_file">Permanent Address Document</label>
                        <input type="file" class="form-control" id="permanet_address_file" name="permanet_address_file" placeholder="Permanent Address Document">
                     </div>
                     	<div class="img">
		               		<img src="<?php echo $old_permanet_address_file;?>" height="200px" width="200px">
		               	</div>
                 </div>

              </div>

              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="addhar_card_no">Addhar Card</label>
                        <input type="text" class="form-control" id="addhar_card_no" name="addhar_card_no" placeholder="<?php echo $old_addhar_card_no;?>" value="<?php echo $old_addhar_card_no;?>">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="addhar_card_file">Addhar Card Photo</label>
                        <input type="file" class="form-control" id="addhar_card_file" name="addhar_card_file" placeholder=" Photo">
                     </div>
                     	<div class="img">
		               		<img src="<?php echo $old_addhar_card_file;?>" height="200px" width="200px">
		               	</div>
                 </div>

              </div>                                 
              
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="pan_card_no">Pan Card</label>
                        <input type="text" class="form-control" id="pan_card_no" name="pan_card_no" placeholder="<?php echo $old_pan_card_no;?>" value="<?php echo $old_pan_card_no;?>">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="pan_card_file">Pan Card Photo</label>
                        <input type="file" class="form-control" id="pan_card_file" name="pan_card_file" placeholder="OPan Card Photo">
                     </div>
                     <div class="img">
		               		<img src="<?php echo $old_pan_card_file;?>" height="200px" width="200px">
		              </div>
                 </div>

              </div>

              <div class="form-group">
                  <label for="salary_amount">Salary Amount</label>
                  <input type="text" class="form-control" id="salary_amount" name="salary_amount" placeholder="<?php echo $old_salary_amount;?>" value="<?php echo $old_salary_amount;?>">
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
    if (isset($_POST['submit']))
   {

    $first_name=$_POST['full_name'];
    $salary_amount=$_POST['salary_amount'];
    $mobile_no=$_POST['mobile_no'];                        
    $pass_photo=$_FILES['pass_photo'];
    $current_address=$_POST['current_address'];
    $current_address_file=$_FILES['current_address_file'];
    $permanet_address=$_POST['permanet_address'];                         
    $permanet_address_file=$_FILES['permanet_address_file'];                     
    $addhar_card_no=$_POST['addhar_card_no'];                        
    $addhar_card_file=$_FILES['addhar_card_file'];
    $pan_card_no=$_POST['pan_card_no'];
    $pan_card_file=$_FILES['pan_card_file'];                        

     //file size compare 
      $size_1=$_FILES['pass_photo']['size'];
      $size_2=$_FILES['current_address_file']['size'];
      $size_3=$_FILES['permanet_address_file']['size'];
      $size_4=$_FILES['addhar_card_file']['size'];
      $size_5=$_FILES['pan_card_file']['size'];

      //location for store file
      $location="../doc/";

      //require file size to upload 
      $require_file_size="3048576";//1 mb size for compare 
      // $require_file_size="104";//1 mb size for compare 
      
          $base_1=$location.basename($_FILES['pass_photo']['name']);
          $base_2=$location.basename($_FILES['current_address_file']['name']);
          $base_3=$location.basename($_FILES['permanet_address_file']['name']);
          $base_4=$location.basename($_FILES['addhar_card_file']['name']);
          $base_5=$location.basename($_FILES['pan_card_file']['name']); 

        $Update_first_name="";
        if ($first_name!="")
        {
            $Update_first_name=$first_name;
        }
        else
        {
            $Update_first_name=$old_first_name;
        }
        $Update_salary_amount="";
        if ($salary_amount!=""){
            $Update_salary_amount=$salary_amount;
        }
        else
        {
            $Update_salary_amount=$old_salary_amount;
        }
        $Update_mobile_no="";
        if ($mobile_no!="")
        {
            $Update_mobile_no=$mobile_no;
        }
        else
        {
            $Update_mobile_no=$old_mobile_no;
        }
        $Update_pass_photo="";
        if ($base_1!="")
        {
            $Update_pass_photo=$base_1;
            move_uploaded_file($_FILES['pass_photo']['tmp_name'], $base_1);
        }
        else
        {
            $Update_pass_photo=$old_pass_photo;
        }

        $Update_current_address="";
        if ($current_address!=""){
            $Update_current_address=$current_address;
        }
        else
        {
            $Update_current_address=$old_current_address;
        }
        $Update_current_address_file="";
        if ($base_2!="")
        {
            $Update_current_address_file=$base_2;
            move_uploaded_file($_FILES['current_address_file']['tmp_name'], $base_2);
        }
        else
        {
            $Update_current_address_file=$old_permanet_address_file;
        }
        $Update_permanet_address="";
        if ($permanet_address!="")
        {
            $Update_permanet_address=$permanet_address;
        }
        else
        {
            $Update_permanet_address=$old_permanet_address;
        }
        $Update_permanet_address_file="";
        if ($base_3!="")
        {
            $Update_permanet_address_file=$base_3;
            move_uploaded_file($_FILES['permanet_address_file']['tmp_name'], $base_3);
        }
        else
        {
            $Update_permanet_address_file=$old_permanet_address_file;
        }
        $Update_addhar_card_no="";
        if ($addhar_card_no!=""){
            $Update_addhar_card_no=$addhar_card_no;
        }
        else
        {
            $Update_addhar_card_no=$old_addhar_card_no;
        }

        $Update_addhar_card_file="";
        if ($base_4!="")
        {
            $Update_addhar_card_file=$base_4;
            move_uploaded_file($_FILES['addhar_card_file']['tmp_name'], $base_4);
        }
        else
        {
            $Update_addhar_card_file=$old_addhar_card_file;
        }

        $Update_pan_card_no="";
        if ($pan_card_no!="")
        {
            $Update_pan_card_no=$pan_card_no;
        }
        else
        {
            $Update_pan_card_no=$old_pan_card_no;
        }
        $Update_pan_card_file="";
        if ($base_5!="")
        {
            $Update_pan_card_file=$base_5;
            move_uploaded_file($_FILES['pan_card_file']['tmp_name'], $base_5);
        }
        else
        {
            $Update_pan_card_file=$old_pan_card_file;
        }

        $update="UPDATE `staff` SET `full_name`='$Update_first_name',`salary_amunt`='$Update_salary_amount',`mobile_no`='$Update_mobile_no',`pass_photo`='$Update_pass_photo',`current_address`='$Update_current_address',`current_address_file`='$Update_current_address_file',`permanet_address`='$Update_permanet_address',`permanet_address_file`='$Update_permanet_address_file',`addhar_card_no`='$Update_addhar_card_no',`addhar_card_file`='$Update_addhar_card_file',`pan_card_no`='$Update_pan_card_no',`pan_card_file`='$Update_pan_card_file' WHERE `id`='$id';";
        $run_update=mysqli_query($conn,$update);
        if ($run_update==true) 
        {
            echo "<script>alert('update succesfully')</script>";
        }
        else
        {
            echo "<script>alert(' fail to update')</script>";
        }
      
   }
 ?>
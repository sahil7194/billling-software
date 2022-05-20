<?php 
   $page_title="Add New Staff";
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
            
            <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="mobile_no">Mobile No.</label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No.">
                     </div>
                 </div>

              </div>

              <div class="form-group">
                  <label for="pass_photo">Photo</label>
                  <input type="file" class="form-control" id="pass_photo" name="pass_photo" placeholder="Mobile No.">
               </div>

                <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                         <label for="current_address">Current Address</label>
                         <textarea class="form-control" id="current_address" name="current_address" rows="4" placeholder=""></textarea>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="current_address_file">Current Address Document</label>
                        <input type="file" class="form-control" id="current_address_file" name="current_address_file" placeholder="Current Address Document">
                     </div>
                 </div>

              </div>

              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                         <label for="permanet_address">Permanent Address</label>
                         <textarea class="form-control" id="permanet_address" name="permanet_address" rows="4" placeholder="Permanent Address"></textarea>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="permanet_address_file">Permanent Address Document</label>
                        <input type="file" class="form-control" id="permanet_address_file" name="permanet_address_file" placeholder="Permanent Address Document">
                     </div>
                 </div>

              </div>

              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="addhar_card_no">Addhar Card</label>
                        <input type="number"  class="form-control" id="addhar_card_no" name="addhar_card_no" placeholder="Addhar Card">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="addhar_card_file">Addhar Card Photo</label>
                        <input type="file" class="form-control" id="addhar_card_file" name="addhar_card_file" placeholder=" Photo">
                     </div>
                 </div>

              </div>                                 
              
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="pan_card_no">Pan Card</label>
                        <input type="text" class="form-control" max="10" min="0" id="pan_card_no" name="pan_card_no" placeholder="Pan Card">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="pan_card_file">Pan Card Photo</label>
                        <input type="file" class="form-control" id="pan_card_file" name="pan_card_file" placeholder="OPan Card Photo">
                     </div>
                 </div>

              </div>

              <div class="form-group">
                  <label for="salary_amount">Salary Amount</label>
                  <input type="text" class="form-control" id="salary_amount" name="salary_amount" placeholder="Salary Amount">
               </div>
                           
              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div> 
<script type="text/javascript">
    $(document).ready(function(){
        $('#addhar_card_no').on('blur',function(){
           let text= $(this).val();
            let le = text.length;
            //alert(le);
            if (le<12) 
            {
                alert('Enter 12 Digit adhar card number');
            }
            if (le>=13) 
            {
                alert('Enter 12 Digit adhar card number');
            }
        });
    });
</script>
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

      if ($require_file_size>=$size_1&&$require_file_size>=$size_2&&$require_file_size>=$size_3&&$require_file_size>=$size_4&&$require_file_size>=$size_5) 
      {
          //base for store in database
          $base_1=$location.basename($_FILES['pass_photo']['name']);
          $base_2=$location.basename($_FILES['current_address_file']['name']);
          $base_3=$location.basename($_FILES['permanet_address_file']['name']);
          $base_4=$location.basename($_FILES['addhar_card_file']['name']);
          $base_5=$location.basename($_FILES['pan_card_file']['name']); 
          if (move_uploaded_file($_FILES['pass_photo']['tmp_name'], $base_1)&&move_uploaded_file($_FILES['current_address_file']['tmp_name'], $base_2)&&move_uploaded_file($_FILES['permanet_address_file']['tmp_name'], $base_3)&&move_uploaded_file($_FILES['addhar_card_file']['tmp_name'], $base_4)&&move_uploaded_file($_FILES['pan_card_file']['tmp_name'], $base_5))
          {                          
             $sql_for_insert_staff="INSERT INTO `staff`(`full_name`, `salary_amunt`, `mobile_no`, `pass_photo`, `current_address`, `current_address_file`, `permanet_address`, `permanet_address_file`, `addhar_card_no`, `addhar_card_file`, `pan_card_no`, `pan_card_file`) VALUES ('$first_name','$salary_amount','$mobile_no','$base_1','$current_address','$base_2','$permanet_address','$base_3','$addhar_card_no','$base_4','$pan_card_no','$base_5')";
             $run_for_insert_staff=mysqli_query($conn,$sql_for_insert_staff);
             if ($run_for_insert_staff==true)
             {
               echo '<script>swal("Done", "Staff added Successfully", "success")</script>';
             }
             else
             {
              echo '<script>swal("opps", "fail add Staff", "error")</script>';
             }
          }
        else
        {
        //echo "<br>file size to large";
        echo '<script>swal("opps", "Fail to upload file", "error")</script>';
        }
      }                          
      else
      {
        //echo "<br>file size to large";
        echo '<script>swal("opps", "file size to large", "error")</script>';
      }

   }
 ?>
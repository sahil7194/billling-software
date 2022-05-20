<?php 
   $page_title="Add New Office";
   $page_icon='<i class="mdi mdi-office menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>

   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">
              <div class="form-group">
                <label for="office_name">Office Name</label>
                <input type="text" class="form-control" id="office_name" name="office_name" placeholder="Office Name">
              </div>
              <div class="form-group">
                <label for="office_owner_name">Office Owner Name</label>
                <input type="text" class="form-control" id="office_owner_name" name="office_owner_name" placeholder="Office Owner Name">
              </div>
              <div class="form-group">
                <label for="office_address">Office Address</label>
                <textarea class="form-control" id="office_address" name="office_address" rows="4" placeholder="Office Address"></textarea>
              </div>
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="office_contact_no">Office Contact No</label>
                        <input type="tel" class="form-control" id="office_contact_no" name="office_contact_no" placeholder="Office Contact No">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                     </div>
                 </div>

              </div>  
              <div class="form-group">
                <label for="gst_no">GST Status</label>
                <select id="gst_status" class="form-control">
                    <option selected disabled>Select Status</option>
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </select>
              </div>
              <div class="form-group" id="gst_fill">
                <label for="gst_no">Office GST NO</label>
                <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="Office GST NO">
              </div>
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="office_incharge">Office HR</label>
                        <input type="text" class="form-control" id="office_incharge" name="office_incharge" placeholder="Office HR">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="office_incharge_contact_no">Office Incharge Contact No</label>
                        <input type="text" class="form-control" name="office_incharge_contact_no" id="office_incharge_contact_no" placeholder="Office Incharge Contact No">
                     </div>
                 </div>

              </div>
              
                 <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="code">
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
            $('#gst_fill').hide();
            $('#gst_status').on('change',function(){
                let val = $(this).val()
                if (val==1)
                 {
                    $('#gst_fill').show();
                 }
                 else
                 {
                   $('#gst_fill').hide(); 
                 }
            });
       });
   </script>
    <?php
   require '../admin_footer.php';
    if (isset($_POST['submit']))
    {
      $office_name=$_POST['office_name'];
      $office_address=$_POST['office_address'];
      $office_owner_name=$_POST['office_owner_name'];
      $office_contact_no=$_POST['office_contact_no'];
      $office_incharge=$_POST['office_incharge'];
      $office_incharge_contact_no=$_POST['office_incharge_contact_no'];
      $gst_no=$_POST['gst_no'];
      $email=$_POST['email'];
      $code=$_POST['code'];
      if ($office_name!="")
      {
        $sql_for_insert="INSERT INTO `office_deatils`(`office_name`, `office_address`, `office_contact_no`, `office_incharge`, `office_incharge_contact_no`,`GstNo`,`Email`,`office_owner_name`,`code`) VALUES ('$office_name','$office_address','$office_contact_no','$office_incharge','$office_incharge_contact_no','$gst_no','$email','$office_owner_name','$code')";
        $run=mysqli_query($conn,$sql_for_insert);
        if ($run = true)
        {
            echo '<script>swal("", "Office Successfully Add !", "success");
            window.location.replace("manage_office.php");
            </script>';

        }
        else
         {
            echo '<script>swal("", "Fail to add Office", "error")</script>';
        }
      }
      else
      {
        echo '<script>swal("", "Office Name Required", "error")</script>';
      }
    }
 
 ?>

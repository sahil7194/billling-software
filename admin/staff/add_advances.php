<?php 
   $page_title="Add Advances";
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
                        <div class="form-group">
                             <label for="staff">Select Staff</label>
                             <select class="form-control" id="staff" name="staff" required>
                               <option selected disabled>Select Staff</option>
                              <?php
                                   $sql_for_select_staff="SELECT `id`, `full_name` FROM `staff` ORDER BY `full_name` ASC";
                                   $run_for_select_staff=mysqli_query($conn,$sql_for_select_staff);
                                   while ($row_for_select_staff=mysqli_fetch_array($run_for_select_staff)) 
                                   {
                                     ?>
                                     <option value="<?php echo $row_for_select_staff['id']; ?>">
                                       <?php echo ucfirst($row_for_select_staff['full_name']); ?>
                                     </option>
                                     <?php
                                   }
                               ?>
                             </select>
                           </div>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <div class="form-group">
                          <label for="item_name">Mode of Payment</label>
                          <select class="form-control" name="payment_mode" required>
                            <option selected disabled>Select Mode of Payment </option>
                            <option value="account trsnfer">Account Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="upi">UPI</option>
                            <option value="cheque">Cheque</option>
                          </select>
                        </div>
                     </div>
                 </div>

              </div>

              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                           <label for="amount">Amount</label>
                           <input type="number" min="0"class="form-control" id="amount" name="amount" placeholder="Amount" required>
                        </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                         <label for="current_address">Reason</label>
                         <textarea class="form-control" id="current_address" name="reson" rows="4" placeholder="Reason" required></textarea>
                     </div>
                  </div>

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
        $staff=$_POST['staff'];
        $mode=$_POST['payment_mode'];
        $amount=$_POST['amount'];
        $reson=$_POST['reson'];

          $insert_advance="INSERT INTO `advances`( `staff_id`, `payment_mode`, `amount`,`reason`) VALUES ('$staff','$mode','$amount','$reson')";
          $run_insert_advance=mysqli_query($conn,$insert_advance);
          if ($run_insert_advance==true)
          {
             echo '<script>swal("", "Advance Added", "success")</script>';
          }
          else
          {
             echo '<script>swal("", "Fail to add ", "error")</script>';
          }
      }
 ?>
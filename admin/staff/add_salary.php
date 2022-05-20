<?php 
   $page_title="Add Salary";
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
            
            <form class="forms-sample" action="" method="post"> 
             <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
               <div class="form-group">
                 <label for="staff">Select Staff</label>
                 <select class="form-control" id="staff_id" name="staff">
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

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="month">Select Month</label>
                       <select class="form-control" id="month" name="month">
                          <option selected disabled>Select Month</option>
                          <option  value='01'>Janaury</option>
                          <option value='02'>February</option>
                          <option value='03'>March</option>
                          <option value='04'>April</option>
                          <option value='05'>May</option>
                          <option value='06'>June</option>
                          <option value='07'>July</option>
                          <option value='08'>August</option>
                          <option value='09'>September</option>
                          <option value='10'>October</option>
                          <option value='11'>November</option>
                          <option value='12'>December</option>
                       </select>
                     </div>
                 </div>

               </div>
               <div class="row">
                 
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="Leave">Leave</label>
                        <input type="text" class="form-control" id="leave" name="leave" placeholder="Leave">
                     </div>
                 </div>
                 
               </div>
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="payment_mode">Select Mode of Payment</label>
                       <select class="form-control" id="payment_mode" name="payment_mode">
                        <option selected disabled>Select Mode of Payment</option>
                        <option value="account trsnfer">Account Transfer</option>
                        <option value="cash">Cash</option>
                        <option value="upi">UPI</option>
                        <option value="cheque">cheque</option>
                       </select>
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" readonly>
                     </div>
                 </div>
                 
               </div>

               <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" id="note" name="note" rows="4" placeholder="Note"></textarea>
              </div>
                <input type="hidden" name="leave_charge_val" id="leave_charge_val">
              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div>
   <script type="text/javascript">
       $(document).ready(function(){
            $('#month').on('change',function(){
                let staff =$('#staff_id').val();                
                let month =$(this).val();             
                $.ajax({
                    url:'get_advanced.php',
                    type:'POST',
                    data:{
                        staff:staff,
                        month:month
                    },
                    success:function(res){
                        $('#amount').val(res);

                        $('#leave').on('change',function(){
                            //alert('hello');
                            let leave = $(this).val();
                            let staff =$('#staff_id').val(); 
                            let current_amount= $('#amount').val();
                            let month =$('#month').val(); 
                           //alert(current_amount);
                            // to get leave cutting chage 
                            $.ajax({
                                url:'get_leave_charge.php',
                                type:'POST',
                                data:{
                                    staff:staff,
                                    month:month
                                },
                                success:function(res){
                                   //alert(res);
                                   $('#leave_charge_val').val(res);
                                   let leave_charge=$('#leave_charge_val').val();
                                    //alert('leave_charge'+leave_charge);
                                    let updaed_amount = current_amount-leave*leave_charge;
                                     $('#amount').val(updaed_amount);
                                }
                            });
                        });
                    }
                });
            });

            
       });
   </script>
   <?php
      require '../admin_footer.php';

       if (isset($_POST['submit']))
        {
          $staff=$_POST['staff'];
          $mode=$_POST['payment_mode'];
          $month=$_POST['month'];
          $amount=$_POST['amount'];
          $note=$_POST['note'];

          if ($staff!="")
          {
              $sql_for_insert_sal="INSERT INTO `salary`(`staff_id`, `payment_mode`, `amount`,`note` ,`month`) VALUES ('$staff','$mode','$amount','$note','$month')";
              $run_for_insert_sal=mysqli_query($conn,$sql_for_insert_sal);
             if ($run_for_insert_sal==true)
             {
               echo '<script>swal("", "Office Successfully Add !", "success")</script>';
             }
             else
             {
              echo '<script>swal("", "Some thing worng !", "error")</script>';
             }
          }
          else
          {
            echo '<script>swal("", "All feild require !", "error")</script>';
          }

        }
 ?>
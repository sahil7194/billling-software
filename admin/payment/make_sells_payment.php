<?php 
   $id=$_GET['id'];
   $company_id=$_GET['company_id'];
   $current_payment=$_GET['amount'];
  
   if ($id==""&&$company_id==""&&$current_payment=="") 
   {
       header('Location:manage_sells_invoice.php');
   }
   $total=$old_amount+$current_payment;
   $page_title="Make Sells Payment";
   $page_icon='<i class="mdi mdi-currency-inr menu-icon"></i>&nbsp;&nbsp';
require 'services_function.php';
   require '../admin_header.php';
 $old_amount=pending_ammount_for_office($company_id);

   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           
             <form action="" method="post">
          <div class="row">
            
             <div class="col-6">
                <label>
                   Amount
                </label>
                <input type="text" name="amount" value="<?php echo $total?>" class="form-control" placeholder="amount" required>
             </div>

             <div class="col-6">
                <div class="form-group">
                       <label for="payment_mode">Select Mode of Payment</label>
                       <select class="form-control" name="payment_mode" required>
                        <option  disabled>Select Mode of Payment</option>
                        <option value="account trsnfer">Account Transfer</option>
                        <option value="cash">Cash</option>
                        <option value="upi">UPI</option>
                        <option value="cheque">Cheque</option>
                       </select>
                     </div>
             </div>
        
          </div>            
              <button type="submit" name="submit" class="btn btn-primary mr-2">Make Payment</button>
              <button class="btn btn-light">Cancel</button>
         </div>
     </form>
     <?php    
    if (isset($_POST['submit']))
    {
        $amount=$_POST['amount'];
        $payment_mode=$_POST['payment_mode'];

        $amount_for_update=$total-$amount;
        $sql_for_insert="INSERT INTO `sells_payment`(`invoice_id`, `office_id`, `amount`, `mode`) VALUES ('$id','$company_id','$amount','$payment_mode');";
        $sql_for_update="UPDATE `office_deatils` SET `pedning_ammount`='$amount_for_update' WHERE `id`='$company_id';";

        $sql_1=$sql_for_insert.$sql_for_update;

        $run_multiple = mysqli_multi_query($conn,$sql_1);
        if ($run_multiple==true) 
        {            
          echo "<script>alert('Data Save');
                    window.location.replace('manage_sells_invoice.php');
          </script>";
        }
        else
        {
          echo "<script>alert('Fail to Save');
                    window.location.replace('manage_sells_invoice.php');
          </script>";
        }
    }
    ?> 
        </div>
      </div> 
   </div>  
        <?php
      require '../admin_footer.php';
 ?>
   

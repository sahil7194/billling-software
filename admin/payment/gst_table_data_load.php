<?php 
require 'services_function.php';
   require '../config.php';

   if (isset($_POST['date'])) 
   {
      $date=$_POST['date'];
   }
?>
<table class="table table-hover">
   <thead>
      <tr>
         <th scope="col">
            sr
         </th>
         <th scope="col">
            Invoice Number
         </th>
         <th scope="col">
            Office Name
         </th>
         <th scope="col">
            Amount
         </th>
         <th scope="col">
            view 
         </th>
         <th>
            Make Payment
         </th>
      </tr>
   </thead>
   <tbody id="gst_table_data">
      <?php 
      $sr=0;   
         $sql_get_data="SELECT `id`,`invoice_number`, `company_id`, `invoice_data`, `total_amount`, `paid_amount`, `gst_status`,DATE(`create_at`) as`date` FROM `sells_invoice_data` WHERE `gst_status`='1' AND MONTH(`create_at`)='$date'";
         $run_get_data=mysqli_query($conn,$sql_get_data);
         while ($row_get_data=mysqli_fetch_array($run_get_data)) 
         {
            $sr=$sr+1;
            $gst_status=$row_get_data['gst_status'];
            ?>
            <tr>
               <td>
                  <?php echo $sr;?>
               </td>
               <td>
                  <?php echo $row_get_data['invoice_number'];?>
               </td>
               <td>
                  <?php echo clientname($row_get_data['company_id']);?>
               </td>
               
               <td>
                  <?php echo $row_get_data['total_amount'];?>
               </td>
               <td>
                  <a href="show_sells_invoice.php?id=<?php echo $row_get_data['id'];?>">
                     <button class="btn btn-primary">
                        <i class="mdi mdi-teamviewer menu-icon" style="font-size:20px;"></i>
                     </button>
                  </a>                                                                 
               </td>
               <td>
                  <a href="make_sells_payment.php?id=<?php echo $row_get_data['id']?>&company_id=<?php echo $row_get_data['company_id']?>&amount=<?php echo $row_get_data['total_amount']?>">
                     <button class="btn btn-primary">
                        <i class="mdi mdi-wallet menu-icon" style="font-size:20px;"></i>
                     </button>
                  </a>                                                                 
               </td>
            </tr>
            <?php
         }
         
       ?>
   </tbody>
</table>

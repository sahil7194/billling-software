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
            Sr
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
           Payment Mode
         </th>     
      </tr>
   </thead>
   <tbody id="gst_table_data">
     <?php 	
     	$sql_for_data="SELECT `invoice_id`, `office_id`, `amount`, `mode` FROM `sells_payment` WHERE MONTH(`create_at`)='$date' ORDER BY `create_at` DESC;";
     	$run_for_data=mysqli_query($conn,$sql_for_data);
     	$sr=0;
     	while ($row_for_data=mysqli_fetch_array($run_for_data)) 
     	{
     		$sr=$sr+1;
     		?>
     		<td>
           		<?php echo $sr; ?>
	         </td>
	         <td>
	            <?php  sells_get_invoice_number($row_for_data['invoice_id']); ?>
	         </td>
	         <td>
	           <?php echo clientname($row_for_data['office_id']); ?>
	         </td>
	         <td>
	           <?php echo $row_for_data['amount']; ?>
	         </td>
	          <td>
	          <?php echo $row_for_data['mode']; ?>
	         </td>     
	      </tr>
     		<?php
     	}
      ?>
   </tbody>
</table>

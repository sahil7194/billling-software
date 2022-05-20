<?php 
require 'config.php';
require 'function_for_office.php';

if (isset($_POST['month'])) 
{
	$month=$_POST['month'];
	$year=$_POST['year'];
}

?>
 <h1>Month <?php echo month($month);?></h1>
  <table class="table table-hover">
  <tr>
     <th>
        Services Name
     </th>
     <th>
        Total Quantity
     </th>
     <th>
        Empty Quantity
     </th>
  </tr>
  <?php    
     $sql="SELECT `id`, `service_name` FROM `services` WHERE `price_type`='unit'";
     $run=mysqli_query($conn,$sql);
     while ($row_1=mysqli_fetch_array($run))
     {
        ?>
      <tr>
        <td width="40%">
           <?php echo $row_1['service_name']; ?>
        </td>
        <td>
           <?php echo total_qunatity_by_services_id_q_month($row_1['id'],$month,$year); ?>
        </td>
        <td>
           <?php echo total_qunatity_by_services_id_emtq_month($row_1['id'],$month,$year); ?>
        </td>
     </tr>
        <?php
     }

   ?>                
     
                  </table>   
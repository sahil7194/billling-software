<?php 
require '../config.php';
 function full_name($id)
  {
    require '../config.php';
    $name="";
    $staff="SELECT `id`, `full_name`  FROM `staff` WHERE `id`='$id';";
    $run=mysqli_query($conn,$staff);
    while ($row=mysqli_fetch_array($run))
    {
      $name=$row['full_name'];
    }
    if ($name!="") 
    {
      $name=$name;
    }
    else
    {
      $name="demo";
    }
    return $name;
  }   
if (isset($_POST['month'])) 
{
	$month=$_POST['month'];
	?>
	<table class="table table-hover">
                <thead>          
                  <tr>
                    <th scope="col"> Sr. No.</th> 
                    <th scope="col"> Staff Name </th> 
                    <th scope="col"> Mode of Payment</th>   
                    <th scope="col"> Reason </th>  
                    <th scope="col"> Amount </th>  
                    <th scope="col"> Date  </th>                  
                  </tr>
                </thead>
                <tbody id="advances">
                <?php
                  $c=0;
                  $sql_for_advances="SELECT `id`, `staff_id`, `payment_mode`, `amount`, `reason`, `date`, `update_at` FROM `advances` WHERE MONTH(`date`)='$month' ORDER BY `date` DESC";
                  $run_for_advances=mysqli_query($conn,$sql_for_advances);
                  while ($row_advances=mysqli_fetch_array($run_for_advances))                    
                   {
                    $c=$c+1;
                      $o_date=$row_advances['date'];

                        $timestamp = strtotime($o_date);
 
                        // Creating new date format from that timestamp
                        $new_date = date("d-m-Y", $timestamp);
                    ?>
                    <tr>
                      <td>
                        <?php echo $c; ?>
                      </td>
                      <td>
                        <?php echo full_name($row_advances['staff_id']);?>
                      </td>
                      <td>
                        <?php echo $row_advances['payment_mode'];?>
                      </td>                     
                      <td>
                        <?php echo $row_advances['reason'];?>
                      </td>
                       <td>
                        <?php echo $row_advances['amount'];?>
                      </td>
                      <td>
                        <?php echo $new_date;?>
                      </td>
                    </tr>
                    <?php                 
                    
                  }
                ?>
               </tbody>
              </table>
	<?php
}
?>
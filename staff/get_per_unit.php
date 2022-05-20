<?php 
require 'function_for_office.php';
   require 'config.php';

	if (isset($_POST['date'])) 
	{
		$date=$_POST['date'];
    $username=$_POST['username'];
	}

?>
<table class="table table-hover mt-1 mt-2">
  <thead>
    <tr>
      <th scope="col">
        Sr.no
      </th>
      <th scope="col">
        Code
      </th>
      <th scope="col">
        Office Name 
      </th>
      <th scope="col">
        Services Name
      </th>
      <th scope="col">
        Qunatity
      </th>
      <th scope="col">
        Empty Qunatity
      </th>
      <th scope="col">
        Date & Time
      </th>
    </tr>
  </thead>
  <tbody id="services_data_unit">
    <?php 

    $timestamp = strtotime($date);

    // Creating new date format from that timestamp
    $new_date = date("d-m-Y", $timestamp);

    $a=0;  
      $sql_for_entry_by_unit="SELECT dailystatusforunit.id, dailystatusforunit.`SeerviceId`, dailystatusforunit.`Quantity`, DATE_FORMAT(dailystatusforunit.`Date`,'%d %M %Y') as `Date`, dailystatusforunit.`time`,dailystatusforunit.empty_quantity,office_deatils.office_name, office_deatils.code FROM dailystatusforunit INNER JOIN office_deatils ON dailystatusforunit.Office_id=office_deatils.id WHERE dailystatusforunit.`Date`='$date' AND dailystatusforunit.doneby='$username' ORDER BY office_deatils.code ASC ";
      $run_for_entry_by_unit=mysqli_query($conn,$sql_for_entry_by_unit);
      $count_row_for_entery_by_unit=mysqli_num_rows($run_for_entry_by_unit);

      if ($count_row_for_entery_by_unit>0)
      {
        while ($row_for_entery_by_unit=mysqli_fetch_array($run_for_entry_by_unit))
        {
        	

          $a=$a+1;
          ?>
          <tr>
            <td>
              <?php echo $a;?>
            </td>
            <td>
              <?php echo $row_for_entery_by_unit['code'];?>
            </td>

            <td>
              <?php echo $row_for_entery_by_unit['office_name']; ?>
            </td>
            <td>
              <?php echo servicesname($row_for_entery_by_unit['SeerviceId']); ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_unit['Quantity']; ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_unit['empty_quantity']; ?>
            </td>
            <td>
              <?php echo$row_for_entery_by_unit['Date']." ".$row_for_entery_by_unit['time']; ?>
            </td>
          </tr>
          <?php
        }
      }
      else
      {
        ?>
        <tr>
          <td colspan="6" align="center">
            NO data Found
          </td>
        </tr>
        <?php
      }                        
     ?>
  </tbody>
</table>
<?php 
require 'services_function.php';
   require '../config.php';

	if (isset($_POST['date'])) 
	{
		$date=$_POST['date'];
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
        Status
      </th>
      <th scope="col">
        Done By 
      </th>
      <th scope="col">
        Date & Time
      </th>
    </tr>
  </thead>
  <tbody id="services_data_month">
    <?php 

      $timestamp = strtotime($date);
      $new_date = date("d-m-Y", $timestamp);

    $a=0;  
      $sql_for_entry_by_month="SELECT dailystatusformonth.id, dailystatusformonth.`SeerviceId`, dailystatusformonth.ServicesStatus,  DATE_FORMAT(dailystatusformonth.Date,'%d %M %Y') as `Date`, dailystatusformonth.time,dailystatusformonth.doneby,office_deatils.office_name, office_deatils.code FROM dailystatusformonth INNER JOIN office_deatils ON dailystatusformonth.Office_id=office_deatils.id WHERE dailystatusformonth.`Date`='$date' ORDER BY office_deatils.code ASC";
      $run_for_entry_by_month=mysqli_query($conn,$sql_for_entry_by_month);
      $count_row_for_entery_by_month=mysqli_num_rows($run_for_entry_by_month);

      if ($count_row_for_entery_by_month>0)
      {
        while ($row_for_entery_by_month=mysqli_fetch_array($run_for_entry_by_month))
        {
        	
          $a=$a+1;
          ?>
          <tr>
            <td>
              <?php echo $a; ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_month['code']; ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_month['office_name']; ?>
            </td>
            <td>
              <?php echo servicesname($row_for_entery_by_month['SeerviceId']); ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_month['ServicesStatus']; ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_month['doneby']; ?>
            </td>
            <td>
              <?php echo $row_for_entery_by_month['Date']." ".$row_for_entery_by_month['time']; ?>
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
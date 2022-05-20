<?php  
	require '../config.php';
	require 'services_function.php';
	if (isset($_POST['companyid']))
	{
		$companyid=$_POST['companyid'];
		$month=$_POST['month'];
	}


 
?>
<div class="col-12">
<table width="100%" border="1">
<tr>
  <td align="center" colspan="2">
   <h4><?php echo clientname($companyid);?></h4>
  </td>
</tr>
<tr>
 <td width="50%">
   Per unit
 </td>
 <td>
   Per Month
 </td>
</tr>
<tr>
<tr>
  <td>
    <table width="100%" style="font-size: 12px;">
      <thead>
          <tr>
            <th scope="col">
              Sr.no
            </th>
            <th scope="col">
              Services Name
            </th>
            <th scope="col">
              QTY
            </th>
            <th scope="col">
              EMP <br>QTY
            </th>
            <th scope="col">
              Done By 
            </th>
            <th scope="col">
              Date
            </th>
          </tr>
        </thead>
         <tbody id="services_data_unit">
        <?php 
        $a=0;  
        $office_per_unit_services=[];
          $sql_for_entry_by_unit="SELECT dailystatusforunit.id, dailystatusforunit.`SeerviceId`, dailystatusforunit.`Quantity`, DATE(dailystatusforunit.`Date`) as `date`, dailystatusforunit.`time`, dailystatusforunit.doneby,dailystatusforunit.empty_quantity,office_deatils.office_name, office_deatils.code FROM dailystatusforunit INNER JOIN office_deatils ON dailystatusforunit.Office_id=office_deatils.id WHERE dailystatusforunit.Office_id ='$companyid' AND MONTH(dailystatusforunit.`Date`)='$month'  ORDER BY DATE(dailystatusforunit.`Date`) ASC";
          $run_for_entry_by_unit=mysqli_query($conn,$sql_for_entry_by_unit);
          $count_row_for_entery_by_unit=mysqli_num_rows($run_for_entry_by_unit);

          if ($count_row_for_entery_by_unit>0)
          {
            while ($row_for_entery_by_unit=mysqli_fetch_array($run_for_entry_by_unit))
            {
              $a=$a+1;

              $o_date=$row_for_entery_by_unit['date'];

                        $timestamp = strtotime($o_date);
 
                        // Creating new date format from that timestamp
                        $new_date = date("d-m-Y", $timestamp);
                       array_push($office_per_unit_services,$row_for_entery_by_unit['SeerviceId']);

              ?>
              <tr>
                <td>
                  <?php echo $a;?>
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
                  <?php echo $row_for_entery_by_unit['doneby']; ?>
                </td>
                <td>
                  <?php echo $new_date; ?>
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
  </td>
  <td class="justify-content-xl-between">
    <table width="100%" style="font-size: 12px;">
        <thead>
            <tr>
              <th scope="col">
                Sr.no
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
                Date
              </th>
            </tr>
           </thead>
           <tbody id="services_data_month">
            <?php 
            $a=0;  
            $services_by_month=[];
              $sql_for_entry_by_month="SELECT dailystatusformonth.id, dailystatusformonth.`SeerviceId`, dailystatusformonth.`ServicesStatus`, DATE(dailystatusformonth.`Date`) as `date`, dailystatusformonth.`time`, dailystatusformonth.doneby,office_deatils.office_name, office_deatils.code FROM dailystatusformonth INNER JOIN office_deatils ON dailystatusformonth.Office_id=office_deatils.id WHERE dailystatusformonth.Office_id ='$companyid' AND MONTH(dailystatusformonth.`Date`)='$month' ORDER BY DATE(dailystatusformonth.`Date`) ASC";
              $run_for_entry_by_month=mysqli_query($conn,$sql_for_entry_by_month);
              $count_row_for_entery_by_month=mysqli_num_rows($run_for_entry_by_month);

              if ($count_row_for_entery_by_month>0)
              {
                while ($row_for_entery_by_month=mysqli_fetch_array($run_for_entry_by_month))
                {
                  $a=$a+1;

                  $o_date_moth=$row_for_entery_by_month['date'];

                        $timestamp = strtotime($o_date_moth);
 
                        // Creating new date format from that timestamp
                        $new_date_moth = date("d-m-Y", $timestamp);
                        array_push($services_by_month, $row_for_entery_by_month['SeerviceId']);
                  ?>
                  <tr>
                    <td>
                      <?php echo $a; ?>
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
                      <?php echo $new_date_moth; ?>
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
  </td>
</tr>
 <td colspan="2">
   total 
 </td>
</tr>
<tr>
 <td>
   <table width="100%">
     <tr>
       <th rowspan="2">
         Services Name 
       </th>
       <th colspan="2">
         Total
       </th>
     </tr>
     <tr>
     	<td>
     		QTY
     	</td>
     	<td>
     		Empty QTY
     	</td>
     </tr>
     <?php 	
     	$a =array_unique($office_per_unit_services);
     	for ($i=0; $i <sizeof($a); $i++)
     	 { 
     		?>
     		<tr>
     			<td>
     				<?php 	
     					echo servicesname($a[$i]);
     				 ?>
     			</td>
     			<td>
     				<?php 
     					echo cal_quantiy_by_month_for_unit_qun($companyid,$a[$i],$month);
     				 ?>
     			</td>
     			<td>
     				<?php 
     					echo cal_quantiy_by_month_for_unit_qun_emp($companyid,$a[$i],$month);
     				 ?>
     			</td>
     		</tr>
     		<?php 
     	}
     ?>
     
   </table>
 </td>
 <td>
    <table width="100%">
     <tr>
       <th rowspan="2">
         Services Name 
       </th>
       <th colspan="2">
         Total
       </th>
   </tr>
   		<tr>
   			<td>
   				DONE
   			</td>
   			<td>
   				NOT
   			</td>
   		</tr>
        <?php 	
      		$b=  array_unique($services_by_month);
     	for ($i=0; $i <sizeof($b) ; $i++)
     	 { 
     		?>
     		<tr>
     			<td>
     				<?php 	
     					echo servicesname($b[$i]);
     				 ?>
     			</td>
     			<td>
     				<?php 
     					echo cal_quantiy_by_month_for_month_done($companyid,$b[$i],$month);
     				 ?>
     			</td>
     			<td>
     				<?php 
     					echo cal_quantiy_by_month_for_month_not($companyid,$b[$i],$month);
     				 ?>
     			</td>
     		</tr>
     		<?php 
     	}
     ?>
     </tr>
   </table>
 </td>
</tr>
</table>
</div>
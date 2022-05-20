<?php
function clientname($i)
  {
    require '../config.php';
    $select="SELECT `id`, `office_name`, `office_owner_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$i'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo $client_name=$row['office_name'];
      
    }
  }
  function servicesname($servicesid)
{
  require '../config.php';
$name='';
  $select="SELECT `id`, `service_name`, `service_des`, `price_type`, `date` FROM `services` WHERE `id`='$servicesid'";
  $run=mysqli_query($conn,$select);
  while ($row=mysqli_fetch_array($run))
  {
    $name=$row['service_name'];
  }

  return $name;
}

  function max_date_form_table($table_name)
  {
    //for max date
    require '../config.php';
    $sql="SELECT MAX(`Date`) as `maxdate` FROM `$table_name`";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $max_date=$row['maxdate'];
    }

    return $max_date;
  }

//for min date
function min_date_form_table($table_name)
{
  require '../config.php';
  $sql="SELECT MIN(`Date`) as `mindate` FROM `$table_name`";
  $run=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($run))
  {
    $min_date=$row['mindate'];
  }

  return $min_date;
}

//function for find min active date for company id  form services table 
function min_active_status_date($companyid)
{
  require '../config.php';
  $sql="SELECT min(`ActiveDate`) as `min_active_date` FROM `services_status` WHERE `CompanyID`='$companyid'";
  $run=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($run))
  {
    $min_active_date=$row['min_active_date'];
  }

  return $min_active_date;
}

function min_last_billing_status_date($companyid)
{
  require '../config.php';
  $sql="SELECT min(`LastBillingDate`) as `min_last_billing_date` FROM `services_status` WHERE `CompanyID`='$companyid'";
  $run=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($run))
  {
    $min_last_billing_date=$row['min_last_billing_date'];
  }

  return $min_last_billing_date;
}

 function hsn_number($service_id)
 {
   require '../config.php';
   $sql="SELECT  `HSN` FROM `services` WHERE `id`='$service_id'";
   $run=mysqli_query($conn,$sql);
   while ($row=mysqli_fetch_array($run))
   {
     $hsn_number=$row['HSN'];
   }

   return $hsn_number;
 }

 function price_type($services_id)
 {
  require '../config.php';
  $sql="SELECT `price_type`FROM `services` WHERE `id`='$services_id'";
  $run=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($run))
  {
    $price_type=$row['price_type'];
  }

  return $price_type;
 }

 function qunatity_for_unit($servicesid,$companyid,$form_date,$to_date)
 {
  require '../config.php';
  $sql="SELECT SUM(`Quantity`) as `sum_qunatiy` FROM `dailystatusforunit` WHERE `Office_id`='$companyid' AND `SeerviceId`='$servicesid' AND `Date` BETWEEN '$form_date' AND '$to_date'";
  $run=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($run))
  {
    $sum_quantity=$row['sum_qunatiy'];
  }

  return $sum_quantity;
 }


 function cal_quantiy_by_month_for_unit_qun($office_id,$service_id,$month)
 {
    require '../config.php';
    $sql="SELECT SUM(`Quantity`) as `sum` FROM `dailystatusforunit` WHERE `Office_id`='$office_id' AND `SeerviceId`='$service_id'AND  MONTH(`Date`)='$month';";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $sum_quantity=$row['sum'];
    }

    return $sum_quantity;
   }
 

  function cal_quantiy_by_month_for_unit_qun_emp($office_id,$service_id,$month)
 {
    require '../config.php';
    $sql="SELECT SUM(`empty_quantity`) as `sum` FROM `dailystatusforunit` WHERE `Office_id`='$office_id' AND `SeerviceId`='$service_id'AND  MONTH(`Date`)='$month';";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $sum_quantity=$row['sum'];
    }

    return $sum_quantity;
   }

function cal_quantiy_by_month_for_month_done($office_id,$service_id,$month)
 {
    require '../config.php';
    $sql="SELECT COUNT(`ServicesStatus`) as `sum` FROM `dailystatusformonth` WHERE `Office_id`='$office_id' AND `SeerviceId`='$service_id'AND  MONTH(`Date`)='$month' AND `ServicesStatus`='DONE';";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $sum_quantity=$row['sum'];
    }

    return $sum_quantity;
   }

function cal_quantiy_by_month_for_month_not($office_id,$service_id,$month)
 {
    require '../config.php';
    $sql="SELECT COUNT(`ServicesStatus`) as `sum` FROM `dailystatusformonth` WHERE `Office_id`='$office_id' AND `SeerviceId`='$service_id'AND  MONTH(`Date`)='$month' AND `ServicesStatus`='NOT';";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $sum_quantity=$row['sum'];
    }

    return $sum_quantity;
   }


?>
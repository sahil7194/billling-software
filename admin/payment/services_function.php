<?php
function clientname($i)
  {
    require '../config.php';
    $select="SELECT `office_name`FROM `office_deatils` WHERE `id`='$i'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo $client_name=$row['office_name'];
      
    }
  }
  function servicesname($servicesid)
{
  require '../config.php';

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

  $sql_1="SELECT min(`LastBillingDate`) as `min_active_date` FROM `services_status` WHERE `CompanyID`='$companyid'";
  $run_1=mysqli_query($conn,$sql_1);
  while ($row_1=mysqli_fetch_array($run_1))
  {
    $date=$row_1['min_active_date'];
  }
  if ($date=="") 
  {
    $sql="SELECT min(`ActiveDate`) as `min_active_date` FROM `services_status` WHERE `CompanyID`='$companyid'";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $date=$row['min_active_date'];
    }
  }
  
  return $date;
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

  $start_date='';

  $sql_for_check_last_billig_date="SELECT `LastBillingDate` FROM `services_status` WHERE `CompanyID`='$companyid' AND `ServiceId`='$servicesid';";
  $run_for_check_last_billing_date=mysqli_query($conn,$sql_for_check_last_billig_date);
  while ($row_last_date=mysqli_fetch_array($run_for_check_last_billing_date))
  {
    $last_b=$row_last_date['LastBillingDate'];
  }
  if ($last_b!="") 
  {

    $date1=date_create($last_b);
    $date2=date_create($form_date);
    $diff=date_diff($date1,$date2);
    $date_diff=$diff->format("%R%a days");
    if ($date_diff<0) 
    {
      $start_date=$last_b; 
      
    }
    else
    {
      $start_date=$form_date;    
    }

  }
  else
  {
    $start_date=$form_date;
  }
  $sql="SELECT SUM(`Quantity`) as `sum_qunatiy` FROM `dailystatusforunit` WHERE `Office_id`='$companyid' AND `SeerviceId`='$servicesid' AND `Date` BETWEEN '$start_date' AND '$to_date'";
  $run=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($run))
  {
    $sum_quantity=$row['sum_qunatiy'];
  }
  if ($sum_quantity>0) 
  {
    $qunatity=$sum_quantity;
  }
  else
  {
    $qunatity=0;
  }
  return $qunatity;
 }

 function convert_amount_in_indain_cur_in_word($number)
 {
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'EighT', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  //return $result . "Rupees  " . $points . " Paise";

  return $result . "Rupees  ";
 }

function company_for_gst_status($comapny_id)
{
   require '../config.php';
      $sql="SELECT  `GstNO` FROM `office_deatils` WHERE `id`=$comapny_id;";
      $run=mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_array($run))
      {
        $gst_no=$row['GstNO'];
      }

      if ($gst_no=='NO') 
      {
        return false;
      }
      elseif ($gst_no=='no')
     {
        return false;
      }
      elseif ($gst_no=='No')
     {
        return false;
    }
      return true;
}

function office_details($office_id,$gst_status)
{
  require '../config.php';
    $select="SELECT `office_name`,`office_address`, `office_contact_no`, `GstNO` FROM `office_deatils` WHERE `id`='$office_id'";
    $run=mysqli_query($conn,$select);
    $data='';
    while ($row=mysqli_fetch_array($run))
    {
       $data.="<br>".$row['office_name'];
       $data.="<br>".$row['office_address'];
       $data.="<br>".$row['office_contact_no'];
       if ($gst_status==1) 
       {
         $data.="<br>".$row['GstNO'];
       }
       else
       {
        $data.="<br>";
       }
       

    }

    return $data;
}


function office_gst_no($i)
  {
    require '../config.php';
    $select="SELECT  `GstNO` FROM `office_deatils` WHERE `id`='$i'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
       $Gst_no=$row['GstNO'];
      
    }

    return $Gst_no;
  }

  function genrate_invoice($companyid,$gst)
  {
    require '../config.php';
    if ($gst==1) 
    {

    }
  } 

  function services_id_by_name($name)
  {
    require '../config.php';
     $sql="SELECT  `id` FROM `services` WHERE `service_name`='$name'";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $hsn_number=$row['id'];
     }

     return $hsn_number;
  }

  function supplier_name($id)
  {
      require '../config.php';
     $sql="SELECT `supplier_name` FROM `supplier` WHERE `id`='$id';";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $supplier_name=$row['supplier_name'];
     }

     return $supplier_name;
  }

  function item_name($id)
  {
      require '../config.php';
     $sql="SELECT  `item_name`FROM `item_data` WHERE `id`='$id';";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $item_name=$row['item_name'];
     }

     return $item_name;
  }

function supplier_details($id)
{
  require '../config.php';
     $sql="SELECT `supplier_name`, `supplier_address`, `supplier_contact_no` FROM `supplier` WHERE `id`='$id';";
     $run=mysqli_query($conn,$sql);
     $data='';
     while ($row=mysqli_fetch_array($run))
     {
       $data.="<br>".$row['supplier_name'];
       $data.="<br>".$row['supplier_address'];
       $data.="<br>".$row['supplier_contact_no'];
     }

     return $data;
}

function purches_invoice()
{
  require '../config.php';
     $sql="SELECT  `last_invoice_number` FROM `supplier_billing_data`;";
     $run=mysqli_query($conn,$sql);
    
     while ($row=mysqli_fetch_array($run))
     {
       $old_num=$row['last_invoice_number'];
     }


  if ($old_num!="") 
      {
        $l=strlen($old_num);
        $ll=$l-1;
        $ls=$l-2;
        $lss=$l-3;
         $s=intval($old_num[$lss].$old_num[$ls].$old_num[$ll]);
         $n=$s+1;
         $new_num;
          for ($i=0; $i <= $lss; $i++) 
          { 
            $new_num.=$old_num[$i];
          }
          $new_num= $new_num.$n;
      }
      else
      {
          $new_num='PO00001';
      }

      return $new_num;
}

function purches_pending_payment($id)
{
  
   require '../config.php';
     $sql="SELECT `total_amount`, `paid_amount` FROM `purches_invoice` WHERE `id`='$id';";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $total_amount=$row['total_amount'];
       $paid_amount=$row['paid_amount'];
     }

     return $total_amount-$paid_amount;
}

function sells_pending_payment($id)
{
  require '../config.php';
     $sql="SELECT `total_amount`, `paid_amount` FROM `sells_invoice_data` WHERE `id`='$id';";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $total_amount=$row['total_amount'];
       $paid_amount=$row['paid_amount'];
     }

     return $total_amount-$paid_amount;
}


function genrate_gst_invoive_no()
{
    require '../config.php';

    $select="SELECT `last_gst_invoice_number`, `last_no_gst_invoice_number` FROM `invoice_count` WHERE `id`=1";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      $last_gst_invoice_number=$row['last_gst_invoice_number'];
    }

    $inital_letter='';
    for ($i=0; $i < 4 ; $i++) 
    { 
        $inital_letter.=$last_gst_invoice_number[$i];
    }
    
    $number='';

    for ($i=4; $i <strlen($last_gst_invoice_number) ; $i++) 
    { 
        $number.=$last_gst_invoice_number[$i];
    }

    $new_number=$inital_letter.$number+1;

    $sql_update="UPDATE `invoice_count` SET `last_gst_invoice_number`='$new_number' WHERE `id`=1;";
    $run_update=mysqli_query($conn,$sql_update);

    return $new_number;
}


function genrate_non_gst_invoive_no()
{
    require '../config.php';

    $select="SELECT `last_no_gst_invoice_number` FROM `invoice_count` WHERE `id`=1";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      $last_gst_invoice_number=$row['last_no_gst_invoice_number'];
    }

    $inital_letter='';
    for ($i=0; $i < 4 ; $i++) 
    { 
        $inital_letter.=$last_gst_invoice_number[$i];
    }
    
    $number='';

    for ($i=4; $i <strlen($last_gst_invoice_number) ; $i++) 
    { 
        $number.=$last_gst_invoice_number[$i];
    }

    $new_number=$inital_letter.$number+1;

    $sql_update="UPDATE `invoice_count` SET `last_no_gst_invoice_number`='$new_number' WHERE `id`=1;";
    $run_update=mysqli_query($conn,$sql_update);

    return $new_number;
}

function last_day_of_month($month)
{
  $end_day;
      switch($month)
      {
        case '1':    
        $end_day="31";
        break;

        case '2':    
        $year=date('Y');
        if ($year%4==0) 
        {
          $end_day="29";
        }
        else
        {
          $end_day="28";
        }
        break;

        case '3':    
        $end_day="31";
        break;

        case '4':    
        $end_day="30";
        break;

        case '5':    
        $end_day="31";
        break;

        case '6':    
        $end_day="30";
        break;

        case '7':    
        $end_day="31";
        break;

        case '8':    
        $end_day="31";
        break;

        case '9':    
        $end_day="30";
        break;

        case '10':    
        $end_day="31";
        break;

        case '11':    
        $end_day="30";
        break;

        case '12':    
        $end_day="31";
        break;

      }
      return $end_day;
}


function pending_ammount_for_office($office_id)
{
  require '../config.php';
     $sql="SELECT `pedning_ammount` FROM `office_deatils` WHERE `id`='$office_id'";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $pedning_ammount=$row['pedning_ammount'];
       
     }
     if ($pedning_ammount!="")
     {
       return $pedning_ammount;
     }
     else
     {
        return 0;
     }
}


function gst_no_state_id($office_id)
{
  require '../config.php';
     $sql="SELECT `GstNO` FROM `office_deatils` WHERE `id`='$office_id'";
     $run=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_array($run))
     {
       $pedning_ammount=$row['GstNO'];       
     }
     $state_id=$pedning_ammount[0].$pedning_ammount[1];
  return $state_id;
}


function sells_get_invoice_number($id)
  {
    require '../config.php';
    $select="SELECT `invoice_number` FROM `sells_invoice_data` WHERE `id`='$id';";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo $client_name=$row['invoice_number'];
      
    }
  }
  
  function purches_get_invoice_number($id)
  {
    require '../config.php';
    $select="SELECT `invoice_number` FROM `purches_invoice` WHERE `id`='$id';";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo $client_name=$row['invoice_number'];
      
    }
  }
?>
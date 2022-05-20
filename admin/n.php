<?php
require '../config.php';
  require 'services_function.php';
  error_reporting('0');
	if ($_POST['companyid'])
	{
		$companyid=$_POST['companyid'];
		$form=$_POST['form'];
		$to=$_POST['to'];
		$gst_status=$_POST['gst_status'];
    if ($gst_status!="") 
    {
      $gst_status=1;
    }
    else
    {
      $gst_status=0;
    }
	}

   $datetime1 = date_create('2016-06-01');
  $datetime2 = date_create('2018-09-21');
 
  // Calculates the difference between DateTime objects
  $interval = date_diff($datetime1, $datetime2);
 
  // Printing result in years & months format
  echo $interval->format('%R%y years %m months');
  
	$r=0;
	$today=date('Y-m-d');
  $data=[];
  $qunatity;
  $sum_of_amount=0;

  $price_type_data=[];
  $services_name_data=[];
  $services_id_data=[];
  $hsn_number_data=[];
  $qunatity_data=[];
  $rate_data=[];
  $price_type_data=[];
  $amount_data=[];

$sql_for_get_services="SELECT `ServiceId`, `price` FROM `services_status` WHERE `CompanyID` ='$companyid'";
$run_for_get_services=mysqli_query($conn,$sql_for_get_services);
while ($row_for_get_services=mysqli_fetch_array($run_for_get_services))
{
	$price_type=price_type($row_for_get_services['ServiceId']);
	array_push($price_type_data, $price_type);

	$services_name=servicesname($row_for_get_services['ServiceId']);
	array_push($services_name_data, $services_name);

	$hsn_number=hsn_number($row_for_get_services['ServiceId']);
	array_push($hsn_number_data, $hsn_number);
  if($month_data==1) 
	{
		
		if ($price_type=='unit') 
		{
			$qunatity=qunatity_for_unit($row_for_get_services['ServiceId'],$companyid,$form,$to);
		}
		else
		{
			$qunatity=1;
		}	

		array_push($qunatity_data, $qunatity);

		$rate=$row_for_get_services['price'];
		array_push($rate_data, $rate);

		$amount=$rate*$qunatity;
		array_push($amount_data, $amount);
		$sum_of_amount=$sum_of_amount+$amount;	

	}
	else
	{
		$qunatity=qunatity_for_unit($row_for_get_services['ServiceId'],$companyid,$form,$to);
		array_push($qunatity_data, $qunatity);

		$rate=$row_for_get_services['price'];
		array_push($rate_data, $rate);

		$amount=$rate*$qunatity;
		array_push($amount_data, $amount);

		$sum_of_amount=$sum_of_amount+$amount;							
	}

	$data=array('services_id' =>,'services_name' => $services_name_data,'hsn_number' => $hsn_number_data,'qunatity' => $qunatity_data,'rate' => $rate_data,'price_type' => $price_type_data,'amount' => $amount_data);

  $json_data=json_encode($data);
}
	?>
<div id="print_content">
<table border="1" width="100%" style="">
  <tr>
    <td colspan="2" align="center" style="border:none;">
      <strong>
        <h2> 
          <?php if ($gst_status==1) 
            {
              echo "Tax Invoice";
              $invoice_number=genrate_gst_invoive_no();
            }
            else
            {
              echo "Invoice";
              $invoice_number=genrate_non_gst_invoive_no();
            }

            ?> 
   </h2>
      </strong>
    </td>
  </tr>
  <tr>
    <td width="50%">
      form
      <?php 
              echo "<br>".$company_name;
        echo "<br>".$company_address;
        echo "<br>".$company_contact_no;
        echo "<br>".$gst_no;
            ;?>
    </td>
    <td>
      <table width="100%">
        <tr >
          <td width="50%" style="border:1px solid black;">
            Invoice Number <strong><?php echo $invoice_number;?></strong>
          </td>
          <td style="border:1px solid black;">
            Dated : <?php echo date('Y-m-d');?>
          </td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            Delivery Note
          </td>
          <td style="border:1px solid black;">
            Mode/ Terms of payment
          </td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            supplier's ref
          </td>
          <td style="border:1px solid black;">
            other reference(s)
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="50%">
      To
       <?php echo office_details($companyid,$gst_status);?>
    </td>
    <td style="border:none;">
      <table width="100%"> 
        <tr>
          <td width="50%" style="border:1px solid black;">
            Buyer's ordr No.
          </td>
          <td style="border:1px solid black;">
            Dated 
          </td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            Despatch Document No.
          </td>
          <td style="border:1px solid black;">
            Dilivery Note Date 
          </td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            Despatched through
          </td>
          <td style="border:1px solid black;">
            Destination 
          </td>
        </tr>
        <tr>
          <td colspan="2" style="border:1px solid black;">
            Terms of Delivery
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="border:none;">
      <table width="100%">
        <tr>
          <th style="border:1px solid black;">Sr.No </th>
          <th style="border:1px solid black;">Description of Goods</th> 
          <th style="border:1px solid black;">HSN/SAC </th>
          <th style="border:1px solid black;">Quantity</th> 
          <th style="border:1px solid black;">Rate</th> 
          <th style="border:1px solid black;">per</th>
          <th style="border:1px solid black;">Amount</th>
        </tr>
       <?php 
              $q_sum;
              $a_sum;
              $to_update_last_billing_date_services=[];
              $not_update_last_billing_date_services=[];
                for($i=0; $i <sizeof($data['services_name']); $i++) 
                { 
                  $q_sum=$q_sum+$data['qunatity'][$i];
                  $a_sum=$a_sum+$data['amount'][$i];
                  $s_name=$data['services_name'][$i];
                  if ($data['qunatity'][$i]==0) 
                  {
                    array_push($not_update_last_billing_date_services, $s_name);
                  }
                  else
                  {
                    array_push($to_update_last_billing_date_services, $s_name);
                  }
                  
                ?>
                  <tr>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php 
                      if ($i==0)
                       {
                        echo "1";
                       }
                       else
                       {
                        echo ($i+1);
                       }
                      ;?>
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $data['services_name'][$i];?>
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $data['hsn_number'][$i];?>
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $data['qunatity'][$i];?>
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $data['rate'][$i];?>
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $data['price_type'][$i];?>
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $data['amount'][$i];?>
                    </td>
                  </tr>
                  <?php
                }
              ?>
            <tr>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
                <td style="border:1px solid black; border-top: none; border-bottom: none; padding-top:90px;"></td>
              </tr>
                <?php   
            if ($gst_status==1) 
            {
                ?>
                <tr>
                  <td> </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;" align="right">
                      OUTPUT CGST
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                     
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;" align="right">
                      9%
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $cgst=$a_sum*0.09; ?>
                    </td>
                  </tr>
                  <tr>
                  <td> </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;" align="right">
                      OUTPUT SGST
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                     
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;" align="right">
                      9%
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      
                    </td>
                    <td style="border:1px solid black; border-top: none; border-bottom: none;">
                      <?php echo $sgst=$a_sum*0.09; ?>
                    </td>
                  </tr>
                <?php
            }?>
        <tr>
          <td style="border:1px solid black; padding-top: 20px;"></td>
          <td style="border:1px solid black;">total </td>
          <td style="border:1px solid black;">Quantity</td>
          <td style="border:1px solid black;"><strong><?php echo $q_sum?></strong></td>
          <td style="border:1px solid black;"></td>
          <td style="border:1px solid black;">Amount</td>
          <td style="border:1px solid black;">  <strong><?php echo $a_sum+$cgst+$sgst;?></strong></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding: 20px 0px 60px 20px; border:none;">
      Amount Chargeable (in words) :<strong ><?php echo convert_amount_in_indain_cur_in_word($a_sum);?></strong>
    </td>
  </tr>
  <?php   
    if ($gst_status==1) 
    {
      $gst_state;
          $gst_no = office_gst_no($companyid);
      for ($i=0; $i <= 1; $i++)
       { 
        $gst_state.=$gst_no[$i];
      }

      if ($gst_state!=27) 
      {
        ?>
          <tr>
    <td colspan="2" style="border:none;">

      <table width="100%" border="1">
        <tr>
          <th rowspan="2">HSN/SAC</th>  
          <th rowspan="2">Taxable Value</th>   
          <th colspan="2" align="center"> Tax</th>  
          <th rowspan="2">total amount</th>
        </tr>
        <tr>
          <td>
            <?php $gst_state;?>
            Rate  
          </td>
          <td>
            Amount
          </td>               
        </tr>
         <?php 
            $sum_final;
              for($j=0; $j <sizeof($data['hsn_number']); $j++)
              {
                ?>
            <tr>
              <td style="border:1px solid black;">
                <?php echo $data['hsn_number'][$j];?>
              </td>
              <td style="border:1px solid black;">
                <?php echo $or_amount=$data['amount'][$j];?>
              </td>
              <td style="border:1px solid black;">
                18 %
              </td>
              <td style="border:1px solid black;">
                <?php echo $s_tax=$data['amount'][$j]*0.18;?>
              </td>              
              <td style="border:1px solid black;">
                <?php echo $fina=$or_amount+$s_tax+$cen_tax;
                  $sum_final=$sum_final+$fina;
                ?>
              </td>
            </tr>
            <?php
              }
            ?>
            <tr style="border:1px solid black;">
              <td>
                
              </td>
              <td align="right" style="margin-right: 60px;">
                Total
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              
              <td style="border:1px solid black;">
                <?php echo $sum_final;?>
              </td>
            </tr>
      </table>
      <tr>
        <?php
      }
      else
      {
        ?>

  <tr>
    <td colspan="2" style="border:none;">

      <table width="100%" border="1">
        <tr>
          <th rowspan="2">HSN/SAC</th>  
          <th rowspan="2">Taxable Value</th>  
          <th colspan="2">Central Tax</th>  
          <th colspan="2">State Tax</th>  
          <th rowspan="2">Total Amount</th>
        </tr>
        <tr>
          <td>
            <?php $gst_state;?>
            Rate  
          </td>
          <td>
            Amount
          </td>
          <td>
            Rate
          </td>
          <td>
            Amount
          </td>         
        </tr>
         <?php 
            $sum_final;
              for($j=0; $j <sizeof($data['hsn_number']); $j++)
              {
                ?>
            <tr>
              <td style="border:1px solid black;">
                <?php echo $data['hsn_number'][$j];?>
              </td>
              <td style="border:1px solid black;">
                <?php echo $or_amount=$data['amount'][$j];?>
              </td>
              <td style="border:1px solid black;">
                9 %
              </td>
              <td style="border:1px solid black;">
                <?php echo $s_tax=$data['amount'][$j]*0.09;?>
              </td>
              <td style="border:1px solid black;">
                9 %
              </td>
              <td style="border:1px solid black;">
                <?php echo $cen_tax=$data['amount'][$j]*0.09;?>
              </td>
              <td style="border:1px solid black;">
                <?php echo $fina=$or_amount+$s_tax+$cen_tax;
                  $sum_final=$sum_final+$fina;
                ?>
              </td>
            </tr>
            <?php
              }
            ?>
            <tr style="border:1px solid black;">
              <td>
                
              </td>
              <td align="right" style="margin-right: 60px;">
                Total
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                <?php echo $sum_final;?>
              </td>
            </tr>
      </table>
      <tr>
         <?php
      }
  ?>
        <td colspan="2" style="padding: 20px 0px 30px 20px; border:none;">
          Amount Chargeable (in words) :<strong ><?php echo convert_amount_in_indain_cur_in_word($sum_final)?></strong>
        </td>
      </tr>
    </td>
  </tr>
<?php }
else{

}?>
  <tr>
    <td width="50%" style="border:none;">
      
    </td>
    <td width="50%" style="border:none; padding: 5px;">
      <strong>Company Bank Details</strong>
        <?php echo $company_name;?>
      <p>Bank Name  : GS Mahanagar Co-Oprative Bank Ltd</p>
      <p>A/C  : 052011200004493</p>
      <p>Branch & IFS Code  : Chandan Nagar & MCBL0960052</p>
    </td>
  </tr>
  <tr>
    <td style="border:none; padding:8px;">
      <strong>Declaration</strong>
<p>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
    </td>
    <td width="50%">
      
    </td>
  </tr>
</table>
</div>

<input type="button" onclick="print_me()" id="create_pdf" value="Print" class="m-2"> 
<script type="text/javascript">
      function print_me()
            {
                var content = document.getElementById('print_content').innerHTML;
                var win = window.open();
                win.document.write(content);
                win.print();
                win.close();
            }
    </script>
    <?php 
    //to save invoice data to data base
    $new_final;
    if ($gst_status==1) 
    {
      $new_final=$a_sum;
    }
    else
    {
      $new_final=$sum_final;
    }


   $sql_to_save_invoive="INSERT INTO `sells_invoice_data`(`invoice_number`, `company_id`, `invoice_data`, `total_amount`, `gst_status`) VALUES ('$invoice_number','$companyid','$json_data','$new_final','$gst_status');";
    $run_to_save_invoice=mysqli_query($conn,$sql_to_save_invoive);
    if ($run_to_save_invoice==true) 
    {
     $sql_bill_date=""; 
      for ($i=0; $i <sizeof($to_update_last_billing_date_services) ; $i++) 
      { 
        $sql_bill_date.=" UPDATE `services_status` SET `LastBillingDate`='$today' WHERE `CompanyID`='$companyid' AND `ServiceId`='".services_id_by_name($to_update_last_billing_date_services[$i])."';";
      }
    $sql_bill_date;
      $run_bill_date=mysqli_multi_query($conn,$sql_bill_date);
      if ($run_bill_date==true) 
      {
         echo "<script>alert('Bill Genrated');</script>";

      }
      else
      {
        echo "<script>alert('Fail to genrate invoice');</script>";
      }
      
      }

    else
    {
      echo "<script>alert('Fail to genrate invoice');</script>";
    }





  ?>
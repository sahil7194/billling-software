<?php
error_reporting('0');
require '../config.php';
  require 'services_function.php';

  if ($_POST['companyid'])
  {
   $companyid=$_POST['companyid'];
   $form=$_POST['form'];
   $to=$_POST['to'];
   $gst_status_get=$_POST['gst_status'];
    if($gst_status_get!="") 
    {
      $gst_status=intval($gst_status_get);
    }
    else
    {
      $gst_status=0;
    }

    $datetime1 = date_create($form);
      $datetime2 = date_create($to);

      $interval = date_diff($datetime1, $datetime2);
       $day=intval($interval->format('%R%a '));
        $month=intval($interval->format('%R%m '));
     

    $gst_status;
      $servicesid_data=[];
      $services_name_data=[];
      $hsn_number_data=[];
      $price_type_data=[];
      $qunatity_data=[];
      $price_data=[];
      $amount_data=[];
     $sql_for_get_services="SELECT `ServiceId`, `price` FROM `services_status` WHERE `CompanyID` ='$companyid'";
      $run_for_get_services=mysqli_query($conn,$sql_for_get_services);
        while ($row_for_get_services=mysqli_fetch_array($run_for_get_services))
      {
        $servicesid=$row_for_get_services['ServiceId'];
        array_push($servicesid_data,$servicesid);
        $services_name=servicesname($row_for_get_services['ServiceId']);
        array_push($services_name_data,$services_name);
        $hsn_number=hsn_number($row_for_get_services['ServiceId']);
        array_push($hsn_number_data,$hsn_number);
        $price_type=price_type($row_for_get_services['ServiceId']);
        array_push($price_type_data,$price_type);
        if ($price_type=='unit') 
          {
               $qunatity=qunatity_for_unit($row_for_get_services['ServiceId'],$companyid,$form,$to);
          }
          else
          {
             $qunatity=1;
          }
           array_push($qunatity_data, $qunatity);
        if ($price_type=='month') 
          {
            if ($month>0) 
            {
              $price=round($row_for_get_services['price']*$month);
            }
            else
            {
              $price=round(($row_for_get_services['price']/30)*$day);
            }
          }
          else
          {
            $price=$row_for_get_services['price'];
          }
          array_push($price_data, $price);

          $amount=$price*$qunatity;
          array_push($amount_data, $amount);
      }

$data= array('servicesid' => $servicesid_data,'services_name' => $services_name_data,'hsn_number' => $hsn_number_data,'price_type' => $price_type_data,'qunatity' => $qunatity_data,'price' => $price_data,'amount'=>$amount_data );
  }
 $json_data=json_encode($data);

 $total_amount=0;
  $total_quantity=0;
  $total_hsgst=0;
  $total_hcgst=0;
  $tax_total=0;
  $cgst=0;
  $sgst=0;
  $gst=0;
  $current_payment=0;
  $previous_due=intval(pending_ammount_for_office($companyid));
  $ttotal_amount=0;
 $state_id=intval(gst_no_state_id($companyid));
?>
<div id="print_content">
<table border="1" width="100%" style="">
  <tr>
    <td colspan="2" align="center" style="border:none;">
      <strong>
        <h2> 
            <?php   
              if ($gst_status===1) 
              {
                echo "Tax Invoice";
              }
              else
              {
                echo "Invoice";
              }

             ?>
         </h2>
      </strong>
    </td>
  </tr>
  <tr>
    <td width="50%" style="padding-left: 20px;">
       Form:-
       <span style="padding-left:15px; padding-right: 6px;">
          <?php 
              echo "<br>".$company_name;
        echo "<br>".$company_address;
        echo "<br>".$company_contact_no;
        if($gst_status=='1') 
            {
               echo "<br>".$gst_no;
            }
            else
            {
              echo "";
            } 
       
            ;?>
       </span>
     
    </td>
    <td>
      <table width="100%">
        <tr >
          <td width="50%" style="border:1px solid black;">
            Invoice Number :- 
            <strong>
               <?php  
                $invoice_number='';
                  if($gst_status=='1') 
                  {
                    echo $invoice_number=genrate_gst_invoive_no();
                  }
                  else
                  {
                    echo $invoice_number=genrate_non_gst_invoive_no();
                  } 
              ?>
            </strong>
            
          </td>
          <td style="border:1px solid black;">
            Dated : <strong><?php echo $invoice_date=last_day_of_month(date('m'))."-".date('m')."-".date('Y'); ?></strong></strong>
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
    <td width="50%" style="padding-left: 20px;">
      
     To :- 
     <span style="padding-left:15px; padding-right: 6px;">
      <?php echo office_details($companyid,$gst_status);?>
     </span>
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
          <?php 
              if ($gst_status===1) 
              {
                ?>
                 <th style="border:1px solid black;">HSN/SAC </th>
                <?php
              }
           ?>  
          <th style="border:1px solid black;">Quantity</th> 
          <th style="border:1px solid black;">Rate</th> 
          <th style="border:1px solid black;">Per</th>
          <th style="border:1px solid black;">Amount</th>
        </tr>
        <?php 
            for ($i=0; $i <sizeof($data['servicesid']); $i++) 
            { 
              ?>              
        <tr>
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
              <?php 
                if ($i==0)
                 {
                  echo "1";
                 }
                 else
                 {
                  echo ($i+1);
                 }
                ?>
           </td>
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
            <?php echo $data['services_name'][$i]?>
           </td>

            <?php 
              if ($gst_status===1) 
              {
                ?>
                 <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
                  <?php echo $data['hsn_number'][$i]?>
                 </td>
                <?php
              }
           ?> 
          
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
            <?php echo $data['qunatity'][$i]; $total_quantity=$total_quantity+$data['qunatity'][$i];?>
            </td>
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
            <?php echo $data['price'][$i]?>
            </td>
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
            <?php echo $data['price_type'][$i]?>
            </td>
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;">
            <?php echo $data['amount'][$i];
                $total_amount=$total_amount+$data['amount'][$i];
            ?>
            </td>
            </tr>
          <?php
            }
         ?>
          <?php 
        if ($gst_status===1) 
        {
          ?>
        <tr>
          <td style="border:1px solid black; border-top: none; border-bottom:none;"></td>
          <td style="border:1px solid black; border-top: none; border-bottom:none;"></td>
           <?php 
              if ($gst_status===1) 
              {
                ?>
                   <td style="border:1px solid black; border-top: none; border-bottom:none;"></td>
                <?php
              }
           ?> 
          
          <td style="border:1px solid black; border-top: none; border-bottom:none;"></td>
          <td style="border:1px solid black; border-top: none; border-bottom:none;"></td>
          <td style="border:1px solid black; border-top: none; border-bottom:none;"></td>
     
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;"><div style="padding-left: 10px; border-top: 3px solid black; width:50%; font-weight: bold;">
            <?php echo $total_amount; ?>
          </div></td>
        </tr>
      
        <tr>
          <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px;"> </td>
          <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px; padding-right: 20px;" align="right"> 
            <?php 
                if ($state_id===27)
                {
                  ?>
                    OUTPUT CGST 
                    <br>
                    OUTPUT SGST
                  <?php
                }
                else
                {
                  ?>
                  GST
                  <?php
                }
             ?>
           
          </td>
          <?php 
              if ($gst_status===1) 
              {
                ?>
                  <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px;"></td>
                <?php
              }
           ?> 
         
          <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px;"></td>
          <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px; padding-right: 20px;" align="right">
              <?php 
                if ($state_id===27)
                {
                  ?>
                    9 <br> 9
                  <?php
                }
                else
                {
                  ?>
                    18
                  <?php
                }
             ?>
           </td>
          <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px; padding-right: 20px;" align="right">
            <?php 
                if ($state_id===27)
                {
                  ?>
                    %<br>%</td>
                  <?php
                }
                else
                {
                  ?>
                  %
                  <?php
                }
             ?>

          <td style="border:1px solid black; border-top: none; border-bottom:none; padding-top: 35px; padding-bottom: 35px;">
            <?php 
                if ($state_id===27)
                {
                    
                  echo $cgst=$total_amount*0.09;
                  echo "<br>";
                  echo $sgst=$total_amount*0.09;
                     
                }
                else
                {
                  echo $gst=$total_amount*0.18;
                }
             ?>
             
          </td>
        </tr>
       <?php } ?>
        <tr>
          <td style="border:1px solid black;"></td>
          <td style="border:1px solid black;">total </td>
          <?php 
              if ($gst_status===1) 
              {
                ?>
                 <td style="border:1px solid black;">Quantity</td>
                <?php
              }
           ?> 
          
          <td style="border:1px solid black;"><?php echo $total_quantity;?></td>
          <td style="border:1px solid black;"></td>
          <td style="border:1px solid black;">Amount</td>
          <td style="border:1px solid black;">
            <strong>
              <?php 
              if ($gst_status==1) 
              {
                if ($state_id===27)
                {
                  $final_amount=$total_amount+$cgst+$sgst;
                }
                else
                {
                  $final_amount=$total_amount+$gst;
                } 
              }
              else
              {
                $final_amount=$total_amount;
              }              
               
                  echo $current_payment=$final_amount;
               ?>
            </strong>                       
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding: 20px 0px 60px 20px; border:none;">
      Amount Chargeable (in words) :<strong ><?php echo convert_amount_in_indain_cur_in_word($current_payment); ?> </strong>
    </td>
  </tr>
  <tr>
      <?php 
        if ($gst_status===1) 
        {
          if ($state_id===27) 
          {
            
          ?>
    <td colspan="2" style="border:none;">

      <table width="100%" border="1">
        <tr>
          <th rowspan="2" width="35%">HSN/SAC</th>  
          <th rowspan="2">Taxable Value</th>  
          <th colspan="2">Central Tax</th>  
          <th colspan="2">State Tax</th>  
          <th rowspan="2">Total Amount</th>
        </tr>
        <tr>
          <td>
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
            for ($i=0; $i <sizeof($data['servicesid']); $i++) 
            { 
              ?>     
          <tr>
            <td>
               <?php echo $data['hsn_number'][$i]?>
            </td>
            <td>
            <?php echo $data['amount'][$i];
                $ttotal_amount=$total_amount+$data['amount'][$i];
            ?>
            </td>
            <td>
             9%
            </td>
            <td>
             <?php 
             echo $hsgst=$data['amount'][$i]*0.09;
                        $total_hsgst=$total_hsgst+$hsgst;
              ?>
            </td>
            <td>
              9%
            </td>
            <td>
              <?php 
              
              echo $hcgst=$data['amount'][$i]*0.09;
                          $total_hcgst=$total_hcgst+$hcgst;
               ?>
            </td>
            <td>
              <?php 
              echo $tax=$hsgst+$hcgst;
                    $tax_total=$tax_total+$tax;
               ?>
            </td>
          </tr>
        <?php }?>
         <tr>
          <td align="right">
            Total
          </td>
          <td>
             <?php echo $ttotal_amount; ?>
          </td>
          <td>
            <strong></strong>
          </td>
          <td>
            <strong><?php echo $total_hsgst;?></strong>
          </td>
          <td>
            
          </td>
          <td>
            <strong><?php echo $total_hcgst;?></strong>
          </td>
          <td>
            <strong><?php echo $tax_total?></strong>
          </td>
        </tr>
      </table>
      <tr>
        <td colspan="2" style="padding: 20px 0px 30px 20px; border:none;">
          Tax Amount (in words) :<strong ><?php echo convert_amount_in_indain_cur_in_word($tax_total); ?></strong>
        </td>
       </tr>
   <?php }
        else
        {
          ?>
            <td colspan="2" style="border:none;">

      <table width="100%" border="1">
        <tr>
          <th  width="35%">HSN/SAC</th>  
          <th >Taxable Value</th>  
          <th >GST</th>    
          <th >Total Amount</th>
        </tr>       
       <?php 
            for ($i=0; $i <sizeof($data['servicesid']); $i++) 
            { 
              ?>     
          <tr>
            <td>
               <?php echo $data['hsn_number'][$i]?>
            </td>
            <td>
            <?php echo $data['amount'][$i];
                $ttotal_amount=$ttotal_amount+$data['amount'][$i];
            ?>
            </td>
            <td>18</td>
            <td>
              <?php 
              echo $tax=round($data['amount'][$i]*0.18);
                   $tax_total=$tax_total+$tax;
               ?>
            </td>
          </tr>
        <?php }?>
         <tr>
          <td align="right">
            Total
          </td>
          <td>
             <?php echo $ttotal_amount; ?>
          </td>
          <td>
            <strong></strong>
          </td>
    
          <td>
            <strong><?php echo $tax_total?></strong>
          </td>
        </tr>
      </table>
      <tr>
        <td colspan="2" style="padding: 20px 0px 30px 20px; border:none;">
          Tax Amount (in words) :<strong ><?php echo convert_amount_in_indain_cur_in_word($tax_total); ?></strong>
        </td>
       </tr>

          <?php
        }
          }
         ?>

      <tr>
        <td colspan="2" style="padding: 10px 0px 30px 20px; border:none;">
          Current Bill Amount :- <strong><?php echo $current_payment; ?></strong> <br>
          Previous Due  :- <strong><?php echo $previous_due; ?></strong> <br>
          Net Payable   :- <strong><?php echo $net_payment=$current_payment+$previous_due;?></strong> <br>
        </td>
      </tr>
    </td>
  </tr>
  <tr>
    <td width="50%" style="border:none;">
      
    </td>
    <td width="50%" style="border:none; padding: 5px;">
       <?php 
        if ($gst_status===1) 
        {
          ?>
      <strong>Company Bank Details</strong>
      <p>Bank Name  : <?php echo $bank_name;?></p>
      <p>A/C  : <?php echo $a_c;?></p>
      <p>Branch & IFS Code  : <?php echo $branch;?> & <?php echo $ifsc;?></p>
      <?php }?>
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
<?php   
$update_array=sizeof($servicesid_data);
  if ($update_array >=1) 
  {
     $sql_for_save_invoice="INSERT INTO `sells_invoice_data`(`invoice_number`, `company_id`, `invoice_data`, `total_amount`, `previous_due`, `net_payable`, `invoice_date`, `gst_status`) VALUES ('$invoice_number','$companyid','$json_data','$current_payment','$previous_due','$net_payment','$invoice_date','$gst_status');";
      $run_for_save_invoice=mysqli_query($conn,$sql_for_save_invoice);
      if ($run_for_save_invoice==true) 
      {
         $update_last_billing_date='';
         for ($i=0; $i <$update_array; $i++) 
         { 
          $update_last_billing_date.="UPDATE `services_status` SET `LastBillingDate`='$invoice_date' WHERE `CompanyID`='$companyid' AND `ServiceId`='$servicesid_data[$i]';";
         }
         $update_last_billing_date;
        $run_multiple = mysqli_multi_query($conn,$update_last_billing_date);
        if ($run_multiple==true) 
        {            
          echo "<script>alert('Data Save');</script>";
        }
        else
        {
          echo "<script>alert('Fail to Save');</script>";
        }
      
      }
      else
      {
        echo "<script>alert('Fail to Save');</script>";
      }
  }


 ?>
<input type="button" onclick="print_me()" id="print" value="Print" class="m-2 btn btn-primary"> 
<input type="button" onclick="generatePDF()" id="print" value="Download Pdf" class="m-2 btn btn-primary"> 
<script type="text/javascript">
  function generatePDF() {
     
        const element = document.getElementById('print_content');
       
        var opt = {
            margin: [40, 15, 35, 15], //top, left, buttom, right,
            filename: '<?php echo $invoice_number;?>.pdf',
            image: {type: 'jpeg',quality: 0.98},
            html2canvas: {
                    scale: 2,
                    bottom: 40
                },
              pagebreak: { mode: ['css']},
            jsPDF: {unit: 'pt', format: 'a4', orientation: 'portrait'}
        };
        var worker = html2pdf();

            console.log(worker);
            worker.set(opt)
                  .from(element)
                  .toPdf()
                  .get('pdf')
                  .then(function (doc) {
                      var totalPages = doc.internal.getNumberOfPages();
                      for (var i=1; i<=totalPages; i++) {
                          if (i > 1) {
                            doc.setPage(i);
                            //?????
                          }
                      }

                 }).save();  
      }
      function print_me()
            {
                var content = document.getElementById('print_content').innerHTML;
                var win = window.open();
                win.document.write(content);
                win.print();
                win.close();
            }
</script>

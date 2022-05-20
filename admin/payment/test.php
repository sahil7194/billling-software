 <?php  
   require 'services_function.php';
      require '../config.php';
  $json_data='{"servicesid":["5","1","2"],"services_name":["Water Bottle Oxymax","Housekeeping","Water Bottle Bisleri "],"hsn_number":["2201","99823","2201"],"price_type":["unit","month","unit"],"qunatity":["230",1,"230"],"price":["150",64067,"60"],"amount":[34500,64067,13800]}';

  $gst_status=1;
  $data=json_decode($json_data,true);

  $total_amount=0;
  $total_quantity=0;
  $total_hsgst=0;
  $total_hcgst=0;
  $tax_total=0;
  $cgst=0;
  $sgst=0;
  $gst=0;
  $current_payment=0;
  $previous_due=0;
  $ttotal_amount=0;
 $state_id=gst_no_state_id(4);

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
      
       </span>
     
    </td>
    <td>
      <table width="100%">
        <tr >
          <td width="50%" style="border:1px solid black;">
            Invoice Number :- 
            <strong>
              <?php 
                if ($gst_status===1) 
                {
                  echo "tax_invoice";
                }
                else
                {
                  echo "invoice";
                }
              ?>
            </strong>
            
          </td>
          <td style="border:1px solid black;">
            Dated : <strong></strong>
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
     
          <td style="padding-left: 15px; border:1px solid black; border-top: none; border-bottom:none;"><div style="padding-left: 10px; border-top: 3px solid black; width:40%; font-weight: bold;">
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
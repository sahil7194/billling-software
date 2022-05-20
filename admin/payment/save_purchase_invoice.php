<?php 
error_reporting('0');
require '../config.php';
require 'services_function.php';
if (isset($_POST['supplier_id'])) 
{
	$supplier_id=$_POST['supplier_id'];
	$form_date=$_POST['form_date'];
	$to_date=$_POST['to_date'];
}

$today=date('Y-m-d');
	$sum;
	$item_data=[];
	$amount_data=[];
	$sql_for_in="SELECT `supplier_name`, `item_name`, `amount` FROM `purches` WHERE `status`='0' AND `supplier_name`='$supplier_id' AND `date` BETWEEN '$form_date' AND '$to_date';";
	$run_for_in=mysqli_query($conn,$sql_for_in);
	while ($row_for_in=mysqli_fetch_array($run_for_in))
	{
		$sum=$sum+$row_for_in['amount'];
		$item_name=item_name($row_for_in['item_name']);
		$amount=$row_for_in['amount'];
		array_push($item_data,$item_name);
		array_push($amount_data,$amount);
	}

	$data=array('item'=>$item_data,'amount'=>$amount_data);
	$json_data=json_encode($data);
?>
<div id="print_content">
<table border="1" width="100%" style="">
	<tr>
		<td colspan="2" align="center" style="border:none;">
			<strong>
				<h2> Purchase Invoice </h2>
			</strong>
		</td>
	</tr>
	<tr>
		<td width="50%">
			To
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
						Invoice Number <strong><?php echo $invoice_number=purches_invoice()?></strong>
					</td>
					<td style="border:1px solid black;">
						Dated <?php echo $today?>
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
			Form
			<?php echo supplier_details($supplier_id)?>
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
					<th style="border:1px solid black;">Sr.No	</th>
					<th style="border:1px solid black;">Item Name</th>	
					<th style="border:1px solid black;">Amount	</th>
				</tr>
				<?php 	
					for ($i=0; $i <sizeof($data['item']) ; $i++) 
					{ 
						?>
						<tr>
							<td style="border:1px solid black;"> <?php 
                      if ($i==0)
                       {
                        echo "1";
                       }
                       else
                       {
                        echo ($i+1);
                       }?></td>
							<td style="border:1px solid black;"><?php echo $data['item'][$i]?></td>
							<td style="border:1px solid black;"><?php echo $data['amount'][$i]?></td>
						</tr>

						<?php
					}
				 ?>				
				<tr>
					<td style="border:1px solid black;">total </td>					
					<td style="border:1px solid black;">Amount</td>
					<td style="border:1px solid black;"><strong><?php echo $sum;?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding: 20px 0px 60px 20px; border:none;">
			Amount Chargeable (in words) :<strong ><?php echo convert_amount_in_indain_cur_in_word($sum);?></strong>
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
  	//save invoice 

  	$sql_to_save="INSERT INTO `purches_invoice`(`supplier_id`,`invoice_number`, `invoice_data`, `total_amount`, `date`) VALUES ('$supplier_id','$invoice_number','$json_data','$sum','$today');";
  	$run_to_save=mysqli_query($conn,$sql_to_save);
  	if ($run_to_save==true) 
  	{
  		$up_billing_date="UPDATE `supplier` SET `last_billing_date`='$today' WHERE `id`='$supplier_id';";
  		$run_billing_date=mysqli_query($conn,$up_billing_date);
  		if ($run_billing_date==true)
  		{
  			$sqp="UPDATE `supplier_billing_data` SET `last_invoice_number`='$invoice_number';";
  			$runqp=mysqli_query($conn,$sqp);
  			echo "<script>alert('bill is genrated');</script>";
  		}
  		else
  		{
  			echo "<script>alert('Fail to genrate bill');</script>";
  		}
  	}
  	else
  	{
  		echo "<script>alert('Fail to genrate bill');</script>";
  	}
   ?>
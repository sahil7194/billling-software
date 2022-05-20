<?php 
  require '../config.php';
  require 'services_function.php';
	if ($_POST['company_id'])
	{
			$companyid=$_POST['company_id'];
			$form=$_POST['form'];
			$to=$_POST['to'];
			$datetime1 = date_create($form);
			$datetime2 = date_create($to);

			$interval = date_diff($datetime1, $datetime2);
		  $day=intval($interval->format('%R%a '));
		  $month=intval($interval->format('%R%m '));
			

			?><div class="table-responsive">
				<table class="table table-hover mt-3">
				  <thead>
					<tr>
						<!-- <th scope="col">
						id
						</th> -->
					  	<th scope="col">
							Desscription of Goods
						</th>
						<th scope="col">
							HSN/SAC
						</th>
						<th scope="col">
							per
						</th>
						<th scope="col">
							Qunatity
						</th>
						<th scope="col">
							Rate
						</th>						
						<th scope="col">
							Amount
						</th>					
					</tr>
				</thead>
				<tbody>
			<?php
			$total_amount=0;
		  $sql_for_get_services="SELECT `ServiceId`, `price` FROM `services_status` WHERE `CompanyID` ='$companyid'";
			$run_for_get_services=mysqli_query($conn,$sql_for_get_services);
			  while ($row_for_get_services=mysqli_fetch_array($run_for_get_services))
			{
				?>
				<tr>
					<!-- <td><?php echo $servicesid=$row_for_get_services['ServiceId'];?></td> -->
					<td><?php echo $services_name=servicesname($row_for_get_services['ServiceId']);?></td>
					<td><?php echo $hsn_number=hsn_number($row_for_get_services['ServiceId']);?></td>
					<td><?php echo $price_type=price_type($row_for_get_services['ServiceId']);?></td>
					<td><?php 
						if ($price_type=='unit') 
						{
								echo $qunatity=qunatity_for_unit($row_for_get_services['ServiceId'],$companyid,$form,$to);
						}
						else
						{
							echo $qunatity=1;
						}				

				?>
				</td>
					<td><?php
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
							echo $price;					
					}
					else
					{
					 echo $price=$row_for_get_services['price'];
					}
					?>
				</td>
					<td><?php echo $amount=round($qunatity*$price);
						$total_amount=$total_amount+$amount;
					 ?></td>				
				</tr>
				<?php

			}
		?>
		<tr>
			<td colspan="3" style="font-weight: bolder;">
				total :- <?php echo convert_amount_in_indain_cur_in_word($total_amount); ?>
			</td>
			<td colspan="3" style="font-weight: bolder;">
				total :- <?php echo $total_amount; ?>
			</td>
		</tr>
		<tr>
				<?php 
					if (company_for_gst_status($companyid)==1) 
					{
						?>
						<td>
							<select class="form-control" id="gst_status" name="gst_status">
     						<option selected disabled>Select Gst Status</option>
     						<option value="1">YES</option>
     						<option value="0">NO</option>
              </select>
						</td>
						<?php
					}
					else
					{
						?>
						<?php
					}
				?>
						
		</tr>
	</tbody>
	</table>
		<input type="hidden"  id="companyid" name="companyid" value="<?php echo $companyid;?>">
		<button id="genate_invoice" name="genate_invoice" class="btn btn-primary">
			Genrate invoice
		</button>
		<script type="text/javascript">
			$(document).ready(function(){
					$('#genate_invoice').on('click',function(){
						let companyid='<?php echo $companyid;?>';
						let form='<?php echo $form;?>';
						let to='<?php echo $to;?>';
						let gst_status =$('#gst_status').val();

						$.ajax({
							url:'genrate_sells_invoice.php',
							type:'POST',
							data:{
									companyid:companyid,
									form:form,
									to:to,
									gst_status:gst_status

							},
							success:function(res)
							{
								//alert(res);
								$('.showbill').html(res);
							}
						});
				   	});
			});
		</script>
		</div>
		<?php
		  }
?>
<?php 
error_reporting('0');
require '../config.php';
require 'services_function.php';
if (isset($_POST['supplier_id'])) 
{
	$supplier_id=$_POST['supplier_id'];
	$form_date=$_POST['form_date'];
	$to_date=$_POST['to_date'];
	?>
	<div class="table-responsive">
	
	<table class="table table-hover">
		<tr>
			<th scope="col">
				item name
			</th>
			<th scope="col">
				amount
			</th>
		</tr>
	
	<?php
	$sum;
	$sql_for_in="SELECT `supplier_name`, `item_name`, `amount` FROM `purches` WHERE `status`='0' AND `supplier_name`='$supplier_id' AND `date` BETWEEN '$form_date' AND '$to_date';";
	$run_for_in=mysqli_query($conn,$sql_for_in);
	while ($row_for_in=mysqli_fetch_array($run_for_in))
	{
		$sum=$sum+$row_for_in['amount'];
		?>
			<tr>
				<td><?php echo item_name($row_for_in['item_name']);?></td>
				<td><?php echo $row_for_in['amount'];?></td>
			</tr>
		<?php
	}
?>
<tr>
	<td colspan="1" align="right">
		total : <?php echo $sum;?>
	</td>
</tr>
<tr>
	<td  align="right">
		Amount in word: <?php echo convert_amount_in_indain_cur_in_word($sum);?>
	</td>
</tr>
</table>
	
	</div>
<?php
}

?>
<button id="genrate_invoice">
	Genrate Inoive
</button>
<script type="text/javascript">
	$(document).ready(function(){
		$('#genrate_invoice').on('click',function(){
			let supplier_id='<?php echo $supplier_id;?>';
			let form_date='<?php echo $form_date;?>';
			let to_date='<?php echo $to_date;?>';
			//alert('hello');
			$.ajax({
				url:'save_purchase_invoice.php',
				type:'POST',
				data:{
					supplier_id:supplier_id,
					form_date:form_date,
					to_date:to_date
				},
				success:function(res)
				{
					$('.showbill').html(res);
				}
			});
		});
	});
</script>
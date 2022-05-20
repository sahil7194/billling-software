<?php 
require '../config.php';
if (isset($_POST['office_id'])) 
{
	$id=$_POST['office_id'];
	$sql_get_payment="SELECT `pedning_ammount` FROM `office_deatils` WHERE `id`='$id';";
	$run_get_paymnet=mysqli_query($conn,$sql_get_payment);
	while ($row_get_payment=mysqli_fetch_array($run_get_paymnet))
	{
		$payment=$row_get_payment['pedning_ammount'];
	}
}

?>
<div class="form-group">
 <label for="office_name">Amount</label>
 <input type="text" name="current_payment" value="<?php echo $payment;?>" value="Payment" class="form-control">
</div>


<input type="hidden" name="total_payment" value="<?php echo $payment;?>" value="Payment" class="form-control">
<div class="form-group">
  <label for="item_name">Mode of Payment</label>
  <select class="form-control" name="payment_mode" required>
    <option selected disabled>Select Mode of Payment </option>
    <option value="account trsnfer">Account Transfer</option>
    <option value="cash">Cash</option>
    <option value="upi">UPI</option>
  </select>
</div>
</div>
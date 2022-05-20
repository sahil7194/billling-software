<?php
 require '../config.php';


		if (isset($_POST['supplier_id'])) 
		{
			$supplier_id=$_POST['supplier_id'];
			$sql_for_item_data="SELECT `id`, `item_name` FROM `item_data` WHERE `supplier_id`='$supplier_id' AND `status`='0';";
			$run_for_item_data=mysqli_query($conn,$sql_for_item_data);
			while ($row_for_item_data=mysqli_fetch_array($run_for_item_data))
			{
				?>
				<option value="<?php echo $row_for_item_data['id'];?>"><?php echo $row_for_item_data['item_name'];?> </option>
				<?php
			}
		}
 ?>
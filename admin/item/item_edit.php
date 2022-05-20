<?php 
   $page_title="Edit Item";
   $page_icon='<i class="mdi mdi-sitemap menu-icon"></i>&nbsp;&nbsp';

   require '../admin_header.php';

   $supplier_id=$_GET['supplier_id'];
   $item_id=$_GET['item_id'];
   $sql_for_old_item="SELECT  `supplier_id`, `item_name` FROM `item_data` WHERE `id`='$supplier_id' AND `supplier_id`='$item_id';";
   $run_for_old_item=mysqli_query($conn,$sql_for_old_item);
   while ($row_for_old_item=mysqli_fetch_array($run_for_old_item)) 
   {
   		$supplier_name_old=$row_for_old_item['supplier_id'];
   		$item_name_old=$row_for_old_item['item_name'];
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
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">              
              <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
	                  <label for="supplier_name">Supplier Name</label>
	                  <small>Current Supplier :- <?php echo supplier_name($supplier_name_old);?></small>
		                 <select class="form-control" id="supplier_name" name="supplier_name">
		                   <option selected disabled>Supplier Name</option>
							<?php 
								$sql_for_supplier_data="SELECT `id`, `supplier_name` FROM `supplier` WHERE `status`='0';";
								$run_for_supplier_data=mysqli_query($conn,$sql_for_supplier_data);
								while($row_supplier_data=mysqli_fetch_array($run_for_supplier_data))
								{
									?>
									<option value="<?php echo $row_supplier_data['id'];?>"><?php echo $row_supplier_data['supplier_name'];?></option>
									<?php
								}
							?>
		                 </select>
	              	 </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="ite_name">Item Name</label>
                        <input type="text" class="form-control" name="ite_name" id="ite_name" placeholder="<?php echo $item_name_old;?>" value="<?php echo $item_name_old;?>">
                     </div>
                 </div>

              </div>
                           
              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div>
   <?php
   require '../admin_footer.php';
   if (isset($_POST['submit']))
   {
   		$supplier_id=$_POST['supplier_name'];
   		$item_name=$_POST['ite_name'];
   		if ($supplier_id!="")
   		{
   			$update_supplier_id=$supplier_id;
   		}
   		else
   		{
   			$update_supplier_id=$supplier_name_old;
   		}

   		if ($item_name!="")
   		{
   			$update_item_name=$item_name;
   		}
   		else
   		{
   			$update_item_name=$item_name_old;
   		}

   		$sql_for_update_item="UPDATE `item_data` SET `supplier_id`='$update_supplier_id',`item_name`='$update_item_name' WHERE `id`='$supplier_id' AND `supplier_id`='$item_id'";
   		$run_for_update_item=mysqli_query($conn,$sql_for_update_item);
   		if ($run_for_update_item)
   		{
   			echo '<script>swal("", "Updated !", "info")</script>';
   		}
   		else
   		{
   			echo '<script>swal("", "Fail to Update !", "error")</script>';
   		}
   }
      
 ?>
<?php 
   $page_title="Add New Item";
   $page_icon='<i class="mdi mdi-sitemap menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
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
                        <input type="text" class="form-control" name="ite_name" id="ite_name" placeholder="Item Name">
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
   			$sql_for_add_item="INSERT INTO `item_data`(`supplier_id`, `item_name`) VALUES ('$supplier_id','$item_name');";
   			$run_for_add_item=mysqli_query($conn,$sql_for_add_item);
   			if ($run_for_add_item==true)
   			{
   				echo '<script>swal("", "Item added Successfully !", "success")</script>';
   			}
   			else
   			{
   				echo '<script>swal("", "Fail to item !", "error")</script>';
   			}

   		}
   }
      
 ?>
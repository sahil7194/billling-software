<?php 
   $page_title="Add New Supplier";
   $page_icon='<i class="mdi mdi-escalator menu-icon"></i>&nbsp;&nbsp';

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
               <div class="form-group">
                  <label for="supplier_name">Supplier Name</label>
                  <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Supplier Name">
               </div>

               <div class="form-group">
                  <label for="supplier_contact_no">Supplier Contact No</label>
                  <input type="text" class="form-control" id="supplier_contact_no" name="supplier_contact_no" placeholder="Supplier Contact No">
               </div>

               <div class="form-group">
                  <label for="supplier_address">Supplier Address</label>
                  <textarea class="form-control" id="supplier_address" name="supplier_address" rows="4" placeholder="Supplier Address"></textarea>
               </div>

               <!-- <div class="form-group">
                  <label for="supplier_item">Suppling Item Name</label>
                  <input type="text" class="form-control" id="supplier_item" name="supplier_item" placeholder="Suppling Item Name">
               </div>    -->         
               
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
           $supplier_name=$_POST['supplier_name'];
           $supplier_address=$_POST['supplier_address'];
           $supplier_contact_no=$_POST['supplier_contact_no'];
          // $supplier_item=$_POST['supplier_item'];
           //check if you supplier addready provided
           $sql_check_supplier="SELECT * FROM `supplier` WHERE `supplier_name`='$supplier_name'";
           $run_check_supplier=mysqli_query($conn,$sql_check_supplier);
           $count_row=mysqli_num_rows($run_check_supplier);
           if ($count_row == 0)
           {
              if ($supplier_name!="")
              {
                  $sql_for_insert="INSERT INTO `supplier`(`supplier_name`, `supplier_address`, `supplier_contact_no`) VALUES ('$supplier_name','$supplier_address','$supplier_contact_no');";
                  $run_insert=mysqli_query($conn,$sql_for_insert);
                  if ($run_insert=true)
                  {
                    echo '<script>swal("", "Supplier added Successfully !", "success")</script>';
                  } 
                  else
                  {
                    echo '<script>swal("", "Fail to add Supplie", "error")</script>';
                  } 
              }
              else
              {
                echo '<script>swal("", "Supplier Name required", "error")</script>';
              }
           }
           else
           {
            echo '<script>swal("", "Supplier already added", "error")</script>';
           }                    
        }
 ?>
<?php 
   $page_title="Edit Supplier";
   $page_icon='<i class="mdi mdi-escalator menu-icon"></i>&nbsp;&nbsp';

   require '../admin_header.php';
   $id=$_GET['id'];
   $count=0;
    $table_data="SELECT `id`, `supplier_name`, `supplier_address`, `supplier_contact_no`, `supplier_item`, `date` FROM `supplier` WHERE `id`='$id'";
    $run_data=mysqli_query($conn,$table_data);
    while($row_table=mysqli_fetch_array($run_data))
    {                        
     $old_supplier_name =$row_table['supplier_name']; 
     $old_supplier_address =$row_table['supplier_address']; 
     $old_supplier_contact_no =$row_table['supplier_contact_no']; 
     $old_supplier_item =$row_table['supplier_item'];                    
    }


   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post">
               <div class="form-group">
                  <label for="supplier_name">Supplier Name</label>
                  <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="<?php echo $old_supplier_name;?>" value="<?php echo $old_supplier_name;?>">
               </div>

               <div class="form-group">
                  <label for="supplier_contact_no">Supplier Contact No</label>
                  <input type="text" class="form-control" id="supplier_contact_no" name="supplier_contact_no" placeholder="<?php echo $old_supplier_contact_no;?>" value="<?php echo $old_supplier_contact_no;?>">
               </div>

               <div class="form-group">
                  <label for="supplier_address">Supplier Address</label>
                  <textarea class="form-control" id="supplier_address" name="supplier_address" rows="4" placeholder="<?php echo $old_supplier_address;?>"></textarea>
               </div>

               <div class="form-group">
                  <label for="supplier_item">Suppling Item Name</label>
                  <input type="text" class="form-control" id="supplier_item" name="supplier_item" placeholder="<?php echo $old_supplier_item;?>" value="<?php echo $old_supplier_item;?>">
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
            $new_spplier_name=$_POST['supplier_name'];
            $new_spplier_address=$_POST['supplier_address'];
            $new_spplier_contact_no=$_POST['supplier_contact_no'];
            $new_spplier_item=$_POST['supplier_item'];
            $nsa="";
            $nsi="";
            if ($new_spplier_address=="")
            {
               $nsa=$old_supplier_address;
            }
            else
            {
               $nsa=$new_spplier_address;
            }

            if ($new_spplier_item=="")
            {
               $nsi=$old_supplier_item;
            }
            else
            {
               $nsi=$new_spplier_item;
            }

            $sql_for_update="UPDATE `supplier` SET `supplier_name`='$new_spplier_name',`supplier_address`='$nsa',`supplier_contact_no`='$new_spplier_contact_no',`supplier_item`='$nsi' WHERE `id`='$id'";
            $run_upate=mysqli_query($conn,$sql_for_update);
            if ($run_update=true)
            {
               echo '<script>swal("", "Supplier Update Successfully", "success")</script>';
            }
            else
            {
               echo '<script>swal("", "Fail to Update Supplier Info", "error")</script>';
            }
         }

 ?>
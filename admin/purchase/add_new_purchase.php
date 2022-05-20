<?php 
   $page_title="Add Purchase";
   $page_icon='<i class="mdi mdi-book-open-variant menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post" enctype="multipart/form-data"> 
             <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
               <div class="form-group">
                 <label for="supplier_name">Select supplier</label>
                 <select class="form-control" id="supplier_name" name="supplier_name">
                   <option selected disabled>Select supplier</option>
                    <?php
                        $select_supplier="SELECT DISTINCT `supplier_name`,`id` FROM `supplier`";
                        $run_supplier=mysqli_query($conn,$select_supplier);
                        while ($row_supplier=mysqli_fetch_array($run_supplier))
                        {
                          ?>
                          <option value="<?php echo $row_supplier['id']?>"><?php echo $row_supplier['supplier_name']?> </option>
                          <?php
                        }
                      ?>
                 </select>
               </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="item_name">Select Item</label>
                       <select class="form-control" id="item_name" name="item_name">
                         <option selected disabled>Select Item</option>

                       </select>
                     </div>
                 </div>

               </div>
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" min="0"class="form-control" id="amount" name="amount" placeholder="Amount">
                     </div>
                 </div>

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" min="0"class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                     </div>
                 </div>
                 
               </div>
               <div class="row">
                

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="supporting_doc">Supporting Document</label>
                        <input type="file" class="form-control" id="supporting_doc" name="supporting_doc" placeholder="Office Incharge Contact No">
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
<script type="text/javascript">
  $(document).ready(function(){
      $('#supplier_name').on('change',function(){
          let supplier_id=$(this).val();

          $.ajax({
            url:'get_item.php',
            type:'POST',
            data:{'supplier_id':supplier_id},
            success:function(res){
              $('#item_name').html(res);
            }
          });
      });
  });
</script>
<?php
  require '../admin_footer.php';
  if (isset($_POST['submit']))
   {
      //echo "<br> Supplier name  ";
       $supplier_name=$_POST['supplier_name'];
      //echo "<br> item name ";
       $item_name=$_POST['item_name'];
      //echo "<br> amount ";
       $amount=$_POST['amount'];
       $quantity=$_POST['quantity'];
      $location="../doc/";
      $supporting_doc=$_FILES['supporting_doc'];
     $base_1=$location.basename($_FILES['supporting_doc']['name']);

      if ($supplier_name!="")
      {
              
                                                     
           echo $sql_insert_purches="INSERT INTO `purches`( `supplier_name`, `item_name`, `amount`, `supporting_doc`,`quantity`) VALUES ('$supplier_name','$item_name','$amount','$base_1','$quantity')";
            $run_insert_purches=mysqli_query($conn,$sql_insert_purches);

            if ($run_insert_purches==true)
            {                                  
              echo '<script>swal(" ", "Data Save", "success")</script>';
            }
            else
            {                                  
              echo '<script>swal(" Opps !", "Fail to save data", "error")</script>';
            }
         
        

        }                          
      
      else
      {                            
        echo '<script>swal(" Opps !", "Supplier Name is required", "error")</script>';
      }
        
    }
    move_uploaded_file($_FILES['supporting_doc']['tmp_name'], $base_1);
                          
 ?>

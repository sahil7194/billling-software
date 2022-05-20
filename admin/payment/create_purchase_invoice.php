<?php 
   $page_title="Create Purchase Invoice";
   $page_icon='<i class="mdi mdi-currency-inr menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
             <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
             
             	<select class="form-control" name="supplier_id" id="supplier_id">
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
             	<div class="ot">
             		
             	</div>  
                <div class="output">
                
             </div>
           	<div class="showbill">
                
            </div>
        </div>
                           </div>
              
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#supplier_id').on('change',function(){
			let supplier_id =$(this).val();

			$.ajax({
				url:'get_supplier_billing_date.php',
				type:'POST',
				data:{
					supplier_id:supplier_id
				},
				success:function(res)
				{
					$('.ot').html(res);
				}
			});
		});
	});
</script>
     <?php
      require '../admin_footer.php';
 ?>
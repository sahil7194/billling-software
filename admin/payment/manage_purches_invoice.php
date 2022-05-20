<?php 
require 'services_function.php';
   $page_title="Manage Purchase Invoice";
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

            <div class="table-responsive">
            	<table class="table table-hover">
            		<thead>
            			<tr>
            				<th scope="col">
            					sr
            				</th>
            				<th scope="col">
            					Invoice Number
            				</th>
            				<th scope="col">
            					Supplier Name
            				</th>
            				<th scope="col">
            					Total Amount
            				</th>
                        <th scope="col">
                           Paid Amount
                        </th>
            				<th scope="col">
            					Pending Amount
            				</th>
            				<th scope="col">
            					Genrated Date
            				</th>
            				<th scope="col">
            					view 
            				</th>
            				<th scope="col">
            					Add Payment 
            				</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php 
            			$sr=0;	
            				$sql_get_data="SELECT `id`, `supplier_id`, `invoice_number`, `invoice_data`, `total_amount`, `paid_amount`,date_format(`date`,'%d %M %y') as `date` FROM `purches_invoice`";
            				$run_get_data=mysqli_query($conn,$sql_get_data);
            				while ($row_get_data=mysqli_fetch_array($run_get_data)) 
            				{
            					$sr=$sr+1;
            					?>
            					<tr>
            						<td>
            							<?php echo $sr;?>
            						</td>
            						<td>
            							<?php echo $row_get_data['invoice_number'];?>
            						</td>
            						<td>
            							<?php echo supplier_name($row_get_data['supplier_id']);?>
            						</td>
            						<td>
            							<?php echo $row_get_data['total_amount'];?>
            						</td>
            						<td>
            							<?php echo $row_get_data['paid_amount'];?>
            						</td>
                              <td><?php  echo $pedning_ammount=$row_get_data['total_amount']-$row_get_data['paid_amount']; ?></td>
            						<td>
            							<?php echo $row_get_data['date'];?>
            						</td>
            						<td>
                                 <a href="show_purchase_invoice.php?id=<?php echo $row_get_data['id'];?>">
                                    <button class="btn btn-primary">
                                       <i class="mdi mdi-teamviewer menu-icon" style="font-size:20px;"></i>
                                    </button>
                                 </a>            							            							
            						</td>
                              <?php    
                                 if ($pedning_ammount>0) 
                                 {
                                    ?>
                                    <td>
                                       <button  type="button" class="btn btn-primary make_payment" data-toggle="modal" data-target="#exampleModal"  value="<?php echo $row_get_data['id'];?>">
                                          <i class="mdi mdi-wallet menu-icon" style="font-size:20px;"></i>
                                       </button>                                 
                                    </td>
                                    <?php
                                 }
                                 else
                                 {
                                    ?>
                                    hello
                                    <?php
                                 }
                               ?>
            						
            					</tr>
            					<?php
            				}
            			 ?>
            		</tbody>
            	</table>
            </div>
         </div>
        </div>
      </div> 
   </div>   
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="invoice_id" name="">
          <div class="row">
             <div class="col-6">
                <label>
                   Amount
                </label>
                <input type="text" name="" id="amount" value="" class="form-control" placeholder="amount">
             </div>

             <div class="col-6">
                <div class="form-group">
                       <label for="payment_mode">Select Mode of Payment</label>
                       <select class="form-control" id="payment_mode" name="payment_mode">
                        <option selected disabled>Select Mode of Payment</option>
                        <option value="account trsnfer">Account Transfer</option>
                        <option value="cash">Cash</option>
                        <option value="upi">UPI</option>
                        <option value="cheque">Cheque</option>
                       </select>
                     </div>
             </div>
             <input type="hidden" name="purchase" id="purchase" value="purchase">
          </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" id="add_payment" class="btn btn-primary">Add Payment</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
   $(document).ready(function(){
      let old=0;
      $('.make_payment').on('click',function(){
            let id = $(this).val();
            $('#invoice_id').val(id);

            $.ajax({
               url:'purches_pendind_amount.php',
               type:'POST',
               data:{
                  id:id
               },
               success:function(res)
               {
                  $('#amount').val(res);
                  old=res;
               }
            });
      });

      $('#add_payment').on('click',function(){

         let invoice_id  =$('#invoice_id').val();
         let amount=$('#amount').val();
         let mode= $('#payment_mode').val();

         $.ajax({
               url:'save_purches_payment.php',
               type:'POST',
               data:{
                  invoice_id:invoice_id,
                  amount:amount,
                  mode:mode,
                  old:old
               },
               success:function(res){
                  alert(res);
                  location.reload();
               }
         });
      });
   });
</script>
      <?php
      require '../admin_footer.php';
 ?>
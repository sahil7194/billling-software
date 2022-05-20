<?php 
require 'services_function.php';
   $page_title="Pending Payment";
   $page_icon='<i class="mdi mdi-currency-inr menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
       <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Sells Payment</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Purches Payment</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="col-6 p-3">
                              <input type="search" id="sells_payment_search" placeholder="Search..." class="form-control">
                          </div>
                          <div class="col-4 p-3">
                            <select id="sells_payment_month" class="form-control">
                               <option selected disabled>Select Month</option>
                                <option  value='1'>Janaury</option>
                                <option value='2'>February</option>
                                <option value='3'>March</option>
                                <option value='4'>April</option>
                                <option value='5'>May</option>
                                <option value='6'>June</option>
                                <option value='7'>July</option>
                                <option value='8'>August</option>
                                <option value='9'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>  
                          </div>
                        <div class="d-none d-xl-flex border-md-right flex-grow-1  p-3 item">
                        <div class="table-responsive">
                           <div class="sells_payment_output">
                              
                           </div>
                        </div>
                      
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">   
                      <div class="col-6 p-3">
                              <input type="search" id="purches_payment_search" placeholder="Search..." class="form-control">
                          </div>
                          <div class="col-4 p-3">
                            <select id="purches_payment_month" class="form-control">
                                     <option selected disabled>Select Month</option>
                                      <option  value='1'>Janaury</option>
                                      <option value='2'>February</option>
                                      <option value='3'>March</option>
                                      <option value='4'>April</option>
                                      <option value='5'>May</option>
                                      <option value='6'>June</option>
                                      <option value='7'>July</option>
                                      <option value='8'>August</option>
                                      <option value='9'>September</option>
                                      <option value='10'>October</option>
                                      <option value='11'>November</option>
                                      <option value='12'>December</option>
                                  </select>  
                          </div>                    
                        <div class="d-none d-xl-flex border-md-right flex-grow-1  p-3 item">
                          <div class="table-responsive">
                           <div class="purches_payment_output">
                              
                           </div>
                        </div>
                        </div>
                    </div>
                    
                  </div>
                </div>
             </div>
          </div>
              
   </div>   
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




   function sell_payment(date)
  {
      $.ajax({
        url:'sell_payment_data_load.php',
        type:'POST',
        data:{
          date:date
        },
        success:function(res){
          $('.sells_payment_output').html(res);
          
          $("#sells_payment_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#gst_table_data tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

          
        }
      });
    
  }



function purches_payment(date)
  {
      $.ajax({
        url:'purches_payment_data_load.php',
        type:'POST',
        data:{
          date:date
        },
        success:function(res){
          $('.purches_payment_output').html(res);

          $("#purches_payment_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#non_gst_table_data tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

        });

        }
      });
  }
   $(document).ready(function(){

      let date ='<?php echo date('m');?>';

      sell_payment(date);
      purches_payment(date);

      $('#sells_payment_month').on('change',function(){
          let month_for_gst=$(this).val();
          sell_payment(month_for_gst);
      });

      $('#purches_payment_month').on('change',function(){
          let month_for_non_gst=$(this).val();
          purches_payment(month_for_non_gst);
      });

     
   });
</script>
 

</script>
      <?php
      require '../admin_footer.php';
 ?>
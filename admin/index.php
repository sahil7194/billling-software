<?php 
   $page_title="Dashboard";
   $page_icon='<i class="mdi mdi-ticket-confirmation menu-icon"></i>&nbsp;&nbsp';
   require 'function_for_office.php';
?>
<?php 
   require 'admin_header.php';
   
   ?>
   <div class="content-wrapper">

      
      <div class="row mb-3">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
            <div class="card">
               <div class="card-body">
                  <h1>Today <?php echo date('Y-m-d'); ?></h1>
                  <table class="table table-hover">
                  <tr>
                     <th>
                        Services Name
                     </th>
                     <th>
                        Total Quantity
                     </th>
                     <th>
                        Empty Quantity
                     </th>
                  </tr>
                  <?php    
                     $sql="SELECT `id`, `service_name` FROM `services` WHERE `price_type`='unit'";
                     $run=mysqli_query($conn,$sql);
                     while ($row_1=mysqli_fetch_array($run))
                     {
                        ?>
                      <tr>
                        <td width="40%">
                           <?php echo $row_1['service_name']; ?>
                        </td>
                        <td>
                           <?php echo total_qunatity_by_services_id_q($row_1['id']); ?>
                        </td>
                        <td>
                           <?php echo total_qunatity_by_services_id_emtq($row_1['id']); ?>
                        </td>
                     </tr>
                        <?php
                     }

                   ?>                
                     
                  </table>      
               </div>
            </div>
         </div>
      </div>
      <div class="row">

         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
            <div class="card">
               <div class="card-body">
                  <h2>Users</h2>
                  <div id="users-chart" style="height:250px;"></div>
               </div>
            </div>
         </div>

          <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
            <div class="card">
               <div class="card-body">
                  <h2>Sells Payment</h2>
                  <div id="sells-chart" style="height:250px;"></div>
               </div>
            </div>
         </div>
      </div>

      <div class="row mt-3"> -->
         <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
            <div class="card">
               <div class="card-body">
                  <h2>GST sells Payment</h2>
                  <div id="gstsell-chart" style="height:250px;"></div>
               </div>
            </div>
         </div>  -->

         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
            <div class="card">
               <div class="card-body">
                  <h2>Purchase</h2>
                  <div id="purches-chart" style="height:250px;"></div>
               </div>
            </div>
         </div>
         
      </div>

       <div class="row mb-3 mt-3">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
            <div class="card">
               <div class="row mt-3 p-3">
                     <div class="col-6">
                        <select id="month" class="form-control">
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
                     <div class="col-6">
                        <select id="year" class="form-control">
                           <option selected disabled>Select Year</option>
                           <option value='2021'>2021</option>
                           <option value='2022'>2022</option>
                        </select>
                     </div>
               </div>
               <div class="card-body" id="month_data">
                  <h1>Month <?php echo $month=month(date('m')); 
                  $year=date('Y');?></h1>
                  <table class="table table-hover">
                  <tr>
                     <th>
                        Services Name
                     </th>
                     <th>
                        Total Quantity
                     </th>
                     <th>
                        Empty Quantity
                     </th>
                  </tr>
                  <?php    
                     $sql="SELECT `id`, `service_name` FROM `services` WHERE `price_type`='unit'";
                     $run=mysqli_query($conn,$sql);
                     while ($row_1=mysqli_fetch_array($run))
                     {
                        ?>
                      <tr>
                        <td width="40%">
                           <?php echo $row_1['service_name']; ?>
                        </td>
                        <td>
                           <?php echo total_qunatity_by_services_id_q_month($row_1['id'],$month,$year); ?>
                        </td>
                        <td>
                           <?php echo total_qunatity_by_services_id_emtq_month($row_1['id'],$month,$year); ?>
                        </td>
                     </tr>
                        <?php
                     }

                   ?>                
                     
                  </table>      
               </div>
            </div>
         </div>
      </div>
       </div>
       <script type="text/javascript">
          $(document).ready(function(){
               $('#year').on('change',function(){
                     let month = $('#month').val();
                     let year =  $(this).val();

                     $.ajax({
                        url:'get_month_status.php',
                        type:'POST',
                        data:{
                           month:month,
                           year:year
                        },
                        success:function(res){
                           $('#month_data').html(res);
                        }
                     });
               });
          });
       </script>
   <script type="text/javascript">
    var donut = new Morris.Donut({
      element: 'users-chart',
      resize: true,
      data: [
        {label: "Staff", value: '<?php echo user_count_staff()?>'},
        {label: "Office", value: '<?php echo user_count_office()?>'},
        {label: "Partner", value: '<?php echo user_count_partner()?>'}
      ],
      hideHover: 'auto'
    });


    var donut = new Morris.Donut({
      element: 'purches-chart',
      resize: true,
     data: [
        {label: "Total Purchase", value: '<?php echo purches_total_amount_sum()?>'},
        {label: "Paid  Purchase", value: '<?php echo purches_paid_amount_sum()?>'},
        {label: "Pending Purchase", value: '<?php echo (purches_total_amount_sum()-purches_paid_amount_sum());?>'}
      ],
      hideHover: 'auto'
    });

    var donut = new Morris.Donut({
      element: 'sells-chart',
      resize: true,
      data: [
        {label: "Total sells", value: '<?php echo sells_total_amount_sum()?>'},
        {label: "Paid  sells", value: '<?php echo sells_paid_amount_sum()?>'},
        {label: "Pending sells", value: '<?php echo (sells_total_amount_sum()-sells_paid_amount_sum());?>'}
      ],
      hideHover: 'auto'
    });


    var donut = new Morris.Donut({
      element: 'gstsell-chart',
      resize: true,
      data: [
        {label: "Total sells", value: '<?php echo sells_total_amount_sum_for_gst()?>'},
        {label: "Paid  sells", value: '<?php echo sells_paid_amount_sum_for_gst()?>'},
        {label: "Pending sells", value: '<?php echo (sells_total_amount_sum_for_gst()-sells_paid_amount_sum_for_gst());?>'}
      ],
      hideHover: 'auto'
    });
    
</script>

   <?php
      require 'admin_footer.php';
 ?>
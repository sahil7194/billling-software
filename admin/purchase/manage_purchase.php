<?php 
   $page_title="Manage Purchase";
   $page_icon='<i class="mdi mdi-book-open-variant menu-icon"></i>&nbsp;&nbsp';
   require '../function_for_office.php';
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
         <div class="grid-margin stretch-card">
           <div class="card">
             <div class="card-body">
               <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4> 
               <div class="row">
              <div class="col-4">
                <input type="text" name="" id="myInput" placeholder="Search" class="form-control">
              </div>  
              <div class="col-4">
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
            </div>            
               <div class="table-responsive">
                <div class="ot"></div>
               </div>
             </div>
           </div>
         </div>
      </div>
   <?php
      require '../admin_footer.php';
 ?>
 <script type="text/javascript">
  function get_data(mon,year)
  {
    $.ajax({
            url:'get_purchase_manage_data.php',
            type:'POST',
            data:{
              month:mon,
              year:year
            },success:function(res)
            {
              $('.ot').html(res);
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#purches_data tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            }
          });
  }
    $(document).ready(function(){
      let mon='<?php echo date('m');?>';
      let year='<?php echo date('Y');?>';
      get_data(mon,year);
      $('#month').on('change',function(){
        //alert('hello');
       let mon= $(this).val();
       get_data(mon,year);
          
      });

      $('#year').on('change',function(){
        //alert('hello');
       let year= $(this).val();
       get_data(mon,year);
          
      });
    });
 </script>
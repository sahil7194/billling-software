<?php 
   $page_title="Manage Order";
   $page_icon='<i class="mdi mdi-playlist-check menu-icon"></i>&nbsp;&nbsp';
   require 'function_for_office.php';
   require 'admin_header.php';
   function services_type($username,$password)
  {
    require 'config.php';

      $select="SELECT  `services_type` FROM `user` WHERE `username`='$username' AND `password`='$password';";
      $run=mysqli_query($conn,$select);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['services_type'];
      }

      return $name;
  }
$services_type=services_type($username,$password); 
   ?>
     <div class="content-wrapper">             
      <div class="card">
        <div class="card-body">
          <?php  
          $services_type=services_type($username,$password); 
              if ($services_type=='month') 
              {
                ?>
                <div class="row">
                      <div class="col-md-4 col-12 p-3">
                              <input type="search" id="per_month_search_text" placeholder="Search..." class="form-control">
                          </div>
                          <div class=" col-md-4 col-12 p-3">
                            <input type="date" id="per_month_date" class="form-control">
                          </div> 
                    </div>                         
                      <div class="d-none d-xl-flex border-md-right flex-grow-1  p-3 item">
                        <div class="per_month_output col-12"></div>
                      </div>

                <?php
              }
              else
              {
                ?>
                    
                      <div class="row">
                  <div class="col-6 p-3">
                      <input type="search" id="per_unit_search_text" placeholder="Search..." class="form-control">
                  </div>
                  <div class="col-4 p-3">
                    <input type="date" id="per_day_date" class="form-control">
                  </div>  
                </div>                     
                  <div class="d-none d-xl-flex border-md-right flex-grow-1  p-3 item">
                    <div class="per_unit_output col-12"></div>
                  </div>
                <?php
              }
           ?>
        </div>
      </div>           
   </div>
   <script type="text/javascript">
     function date_for_per_unit(date)
      {
        let username ='<?php echo $username?>';
          $.ajax({
            url:'get_per_unit.php',
            type:'POST',
            data:{
              date:date,
              username:username
            },
            success:function(res){
              $('.per_unit_output').html(res);
             // alert(res);
              $("#per_unit_search_text").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#services_data_unit tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            }
          });
        
      }

    function date_for_per_month(date)
      {
         let username ='<?php echo $username?>';
          $.ajax({
            url:'get_per_month.php',
            type:'POST',
            data:{
              date:date,
              username:username
            },
            success:function(res){
              $('.per_month_output').html(res);

              $("#per_month_search_text").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#services_data_month tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });

            }
          });
      }

      $(document).ready(function(){
       // alert('hello');
        let date ='<?php echo date('Y-m-d');?>';

         date_for_per_unit(date);
         date_for_per_month(date);
          $('#per_day_date').on('change',function(){

            let per_day_date=$(this).val();
           // alert(per_day_date);

          date_for_per_unit(per_day_date);
          });

          $('#per_month_date').on('change',function(){

              let per_month_date=$(this).val();
             // alert('per_month_date');
              date_for_per_month(per_month_date);
          });
      });

   </script>
  <?php
      require 'admin_footer.php';
 ?>
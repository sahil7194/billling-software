<?php 
   $page_title="Manage Advances";
   $page_icon='<i class="mdi mdi-human-male-female menu-icon"></i>&nbsp;&nbsp';
  function full_name($id)
  {
    require '../config.php';
    $name="";
    $staff="SELECT `id`, `full_name`  FROM `staff` WHERE `id`='$id';";
    $run=mysqli_query($conn,$staff);
    while ($row=mysqli_fetch_array($run))
    {
      $name=$row['full_name'];
    }
    if ($name!="") 
    {
      $name=$name;
    }
    else
    {
      $name="demo";
    }
    return $name;
  }   
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
              <div class="ot">
               
              <table class="table table-hover">
                <thead>          
                  <tr>
                    <th scope="col"> Sr. No.</th> 
                    <th scope="col"> Staff Name </th> 
                    <th scope="col"> Mode of Payment</th>   
                    <th scope="col"> Reason </th>  
                    <th scope="col"> Amount </th>  
                    <th scope="col"> Date  </th>                  
                  </tr>
                </thead>
                <tbody id="advances">
                <?php
                  $c=0;
                  $sql_for_advances="SELECT `id`, `staff_id`, `payment_mode`, `amount`, `reason`, `date`, `update_at` FROM `advances` WHERE MONTH(`date`)='$current_month' ORDER BY `date` DESC";
                  $run_for_advances=mysqli_query($conn,$sql_for_advances);
                  while ($row_advances=mysqli_fetch_array($run_for_advances))                    
                   {
                    $c=$c+1;
                      $o_date=$row_advances['date'];

                        $timestamp = strtotime($o_date);
 
                        // Creating new date format from that timestamp
                        $new_date = date("d-m-Y", $timestamp);
                    ?>
                    <tr>
                      <td>
                        <?php echo $c; ?>
                      </td>
                      <td>
                        <?php echo full_name($row_advances['staff_id']);?>
                      </td>
                      <td>
                        <?php echo $row_advances['payment_mode'];?>
                      </td>                     
                      <td>
                        <?php echo $row_advances['reason'];?>
                      </td>
                       <td>
                        <?php echo $row_advances['amount'];?>
                      </td>
                      <td>
                        <?php echo $new_date;?>
                      </td>
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
   </div>
   <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#advances tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $('#month').on('change',function(){
    //alert('hello');
   let mon= $(this).val();
      $.ajax({
        url:'get_addv.php',
        type:'POST',
        data:{
          month:mon
        },success:function(res)
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
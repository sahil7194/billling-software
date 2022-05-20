<?php 
   $page_title="Manage Salary";
   $page_icon='<i class="mdi mdi-human-male-female menu-icon"></i>&nbsp;&nbsp';
    function full_name($id)
    {
      require '../config.php';

      $staff="SELECT `id`, `full_name`  FROM `staff` WHERE `id`='$id';";
      $run=mysqli_query($conn,$staff);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['full_name'];
      }

      return $name;
    }

    function month($month_id)
    {
      $month_name;
      switch($month_id)
      {
        case '1':    
        $month_name="Janaury";
        break;

        case '2':    
        $month_name="February";
        break;

        case '3':    
        $month_name="March";
        break;

        case '4':    
        $month_name="April";
        break;

        case '5':    
        $month_name="May";
        break;

        case '6':    
        $month_name="June";
        break;

        case '7':    
        $month_name="July";
        break;

        case '8':    
        $month_name="August";
        break;

        case '9':    
        $month_name="September";
        break;

        case '10':    
        $month_name="October";
        break;

        case '11':    
        $month_name="November";
        break;

        case '12':    
        $month_name="December";
        break;

      }

      return $month_name;
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
            <div class="ot">            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>          
                  <tr>
                     <th scope="col">Sr.No </th>  
                     <th scope="col">Staff Name</th>  
                     <th scope="col">Mode of Payment</th>   
                     <th scope="col">Month</th>
                     <th scope="col"> Amount </th>  
                     <th scope="col">Note </th> 
                     <th scope="col">Date</th>
                     <th>Print</th>
                  </tr>
                </thead>
                <tbody id="staff_data">
                    <?php
                    $c=0;
                      $select_for_salary="SELECT `id`,`staff_id`, `payment_mode`, `amount`, `month`, `note`, DATE(`date`) as `date` FROM `salary` WHERE MONTH(`date`)='$current_month' ORDER BY `date` DESC";
                      $run_for_salary=mysqli_query($conn,$select_for_salary);
                      $row_count_for_salary=mysqli_num_rows($run_for_salary);
                      if ($row_count_for_salary > 0) 
                      {
                       
                        while ($row_for_salary=mysqli_fetch_array($run_for_salary)) 
                        {
                           $c=$c+1;

                           $o_date=$row_for_salary['date'];

                            $timestamp = strtotime($o_date);
     
                            // Creating new date format from that timestamp
                            $new_date = date("d-m-Y", $timestamp);
                          ?>
                          <tr>
                            <td>
                              <?php echo $c;?>
                            </td>
                            <td>
                             <?php echo full_name($row_for_salary['staff_id']); ?>
                            </td>
                            <td>
                             <?php echo $row_for_salary['payment_mode']; ?>
                            </td>
                            <td>
                              <?php echo month($row_for_salary['month']); ?>                             
                            </td>
                            <td>
                             <?php echo $row_for_salary['amount']; ?>
                            </td>
                            <td>
                             <?php echo $row_for_salary['note']; ?>
                            </td>
                            <td>
                             <?php echo $new_date; ?>
                            </td>
                             <td>
                              <a href="print_sal_info.php?id=<?php echo $row_for_salary['id']; ?>" class="btn btn-info">
                                print
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                      else
                      {
                        ?>
                        <tr>
                          <td colspan="6" align="center">
                             NO Data Found
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
    $("#staff_data tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $('#month').on('change',function(){
    //alert('hello');
   let mon= $(this).val();
      $.ajax({
        url:'get_sal.php',
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
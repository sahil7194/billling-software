<?php 
   $page_title="Order Summary";
   $page_icon='<i class="mdi mdi-shape-plus menu-icon"></i>&nbsp;&nbsp';
   require 'services_function.php';
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
       <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Per Unit</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Per Month</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="total-tab" data-toggle="tab" href="#total" role="tab" aria-controls="total" aria-selected="false">Total's</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                          <div class="col-6 p-3">
                              <input type="search" id="per_unit_search_text" placeholder="Search..." class="form-control">
                          </div>
                          <div class="col-4 p-3">
                            <input type="date" id="per_day_date" class="form-control">
                          </div>  
                        <div class="d-none d-xl-flex border-md-right flex-grow-1  p-3 item">
                          <div class="per_unit_output col-12"></div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">      
                          <div class="col-6 p-3">
                              <input type="search" id="per_month_search_text" placeholder="Search..." class="form-control">
                          </div>
                          <div class="col-4 p-3">
                            <input type="date" id="per_month_date" class="form-control">
                          </div>  
                        <div class="d-none d-xl-flex border-md-right flex-grow-1  p-3 item">
                          <div class="per_month_output col-12"></div>
                        </div>
                    </div>
                    </div>

                    <div class="tab-pane fade" id="total" role="tabpanel" aria-labelledby="total-tab">
                      <div class="justify-content-xl-between">                       
                        <div class="card">
                           <div class="row">
                            <div class="col-6 m-3">
                              <label for="companyid">Select Office</label>
                               <select class="form-control" id="companyid" name="companyid">
                                 <option selected disabled>-- Select Office --</option>
                                  <?php 
                                      $sql_for_com="SELECT `id`, `office_name` FROM `office_deatils` WHERE `status`='0' ORDER BY `code` ASC";
                                      $run_for_com=mysqli_query($conn,$sql_for_com);
                                      if (mysqli_num_rows($run_for_com)==0)
                                      {
                                          ?>
                                              <option> NO data found</option>
                                          <?php
                                      }
                                      else
                                      {
                                          while ($row_for_com=mysqli_fetch_array($run_for_com)) 
                                          {
                                            ?>
                                            <option value="<?php echo $row_for_com['id'];?>"><?php echo $row_for_com['office_name'];?></option>
                                            <?php
                                          }
                                      }
                                     
                                   ?>
                               </select>
                             </div>
                             <div class="col-6 m-3">
                              <label for="companyid">Select Office</label>
                          
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
                            <div id="print_content">
                            <div class="output">
                              
                                
                              </div>
                           </div>
                          <div class="col-4 m-3">
                            <button class="btn btn-primary" id="print_button">
                              print
                            </button>

                            <button class="btn btn-primary" onclick="generatePDF()">Download as PDF</button>
                          </div>
                            
                            </div>
                        </div>   
                    </div>
                  </div>
                </div>
             </div>
          </div>
              
   </div>   
   <script>
      function generatePDF() {
     
        const element = document.getElementById('print_content');
       
        var opt = {
            margin: [40, 15, 35, 15], //top, left, buttom, right,
            filename: 'order_summary.pdf',
            image: {type: 'jpeg',quality: 0.98},
            html2canvas: {
                    scale: 2,
                    bottom: 40
                },
              pagebreak: { mode: ['css']},
            jsPDF: {unit: 'pt', format: 'a4', orientation: 'portrait'}
        };
        var worker = html2pdf();

            console.log(worker);
            worker.set(opt)
                  .from(element)
                  .toPdf()
                  .get('pdf')
                  .then(function (doc) {
                      var totalPages = doc.internal.getNumberOfPages();
                      for (var i=1; i<=totalPages; i++) {
                          if (i > 1) {
                            doc.setPage(i);
                            //?????
                          }
                      }

                 }).save();  
      }

  function date_for_per_unit(date)
  {
      $.ajax({
        url:'get_per_unit.php',
        type:'POST',
        data:{
          date:date
        },
        success:function(res){
          $('.per_unit_output').html(res);
          
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
      $.ajax({
        url:'get_per_month.php',
        type:'POST',
        data:{
          date:date
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


  function print_me()
            {
                var content = document.getElementById('print_content').innerHTML;
                var win = window.open();
                win.document.write(content);
                win.print();
                win.close();
            }
  $(document).ready(function(){
    let date ='<?php echo date('Y-m-d');?>';

       date_for_per_unit(date);
       date_for_per_month(date);
      $('#month').on('change',function(){
          let month = $(this).val();
          let companyid = $('#companyid').val();
          $.ajax({
              url:'print_office_order_summary.php',
              type:'POST',
              data:{
                month:month,
                companyid:companyid
              },
              success:function(res){
                  $('.output').html(res);
              }
          });
      });

      $('#per_day_date').on('change',function(){
          let per_day_date=$(this).val();
          date_for_per_unit(per_day_date);
      });

      $('#per_month_date').on('change',function(){
          let per_month_date=$(this).val();
          date_for_per_month(per_month_date);
      });

      $('#print_button').on('click',function(){
       
          generatePDF();
      });
  });
      
    </script>
   <?php
      require '../admin_footer.php';
 ?>
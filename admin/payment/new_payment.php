<?php 
   $page_title="New Payment";
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
            
               <div class="form-group">
                 <label for="office_name">Office Name</label>
                 <select class="form-control" id="office_name">
                   <option selected disabled>Select Office Name</option>
                   <?php 
                        $sql_for_com="SELECT `id`, `office_name` FROM `office_deatils` ORDER BY `office_name` ASC";
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
               
               <div class="date">
                     <div class="row">

                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                           <label for="fomr_date">Form Date</label>
                           <input type="date" class="form-control" id="fomr_date">
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <div class="form-group">
                           <label for="to_date">To Date</label>
                           <input type="date" class="form-control" id="to_date">
                        </div>
                    </div>                
                    
                 </div> 
               </div>
               
              <button type="submit" id="check-bill" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>

              <div class="showbill">
                 
              </div>
         </div>
        </div>
      </div> 
   </div>   
   <script type="text/javascript">
      $(document).ready(function(){

         $('#office_name').on('change',function(){
          let companyid = $('#office_name').val();
          
          $.ajax({
            url:"new_sell_date.php",
            type:"POST",
            data:'companyid='+ companyid,
            beforeSend:function(){
              $('.date').html('<span> Data is loading </span>');
            },
            success:function(data){
              $('.date').html(data);
            }

          });
      });
      
     

        $('#check-bill').on('click',function(){
            let company_id=$('#office_name').val();
            let form =$('#form-data').val();
            let to  =$('#to-data').val();
            
            if (company_id!="")
             {
                if (form!="")
                 {
                    if (to!="") 
                    {
                      var date1 = new Date(form);
                        var date2 = new Date(to);
                          
                        // To calculate the time difference of two dates
                        var Difference_In_Time = date2.getTime() - date1.getTime();
                          
                        // To calculate the no. of days between two dates
                        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                          
                        //To display the final no. of days (result)
                       if (Difference_In_Days>0)
                        {
                            $.ajax({
                                        url:"check_services.php",
                                        type:"POST",
                                        data:{
                                          "company_id":company_id,
                                          "form":form,
                                          "to":to
                                        },
                                        beforeSend:function(){
                                          $('.showbill').html('<span>Data is loading....</span>');
                                        },
                                        success:function(data){
                                            $('.showbill').html(data);
                                        }
                                   });
                        }
                        else
                        {
                           swal("", "Please select Valid date", "error"); 
                        }
                       
                    }
                    else
                    {
                      swal("", "Please select to date", "error");
                    }
                 }
                 else
                 {
                  swal("", "Please select form date", "error");
                 }
             }
            else
            {
              swal("", "Please select office", "error");
            }

        });

      });
   </script>
   <?php
      require '../admin_footer.php';
 ?>
<?php 
   $page_title="Add Order";
   $page_icon='<i class="mdi mdi-playlist-check menu-icon"></i>&nbsp;&nbsp';

	function companyname($companyid)
	{
	  require 'config.php';

	  $select="SELECT `id`, `office_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$companyid'";
	  $run=mysqli_query($conn,$select);
	  while ($row=mysqli_fetch_array($run))
	  {
	    $name=$row['office_name'];
	  }

	  return $name;
	}

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
   require 'admin_header.php';
   
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            <?php

            $date=date('Y-m-d');
              $min_date=date('Y-m-d', strtotime('-3 day', strtotime($date)))
            ?>
              <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="userfrom">Select Date</label>
                       <input type="date" name="date" id="date" class="form-control" min="<?php echo $min_date?>" max="<?php echo $date;?>">
                     </div>
                 </div>


                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
               <div class="form-group">
                 <label for="office">Select Office</label>
                 <select name="office" class="form-control" id="office_name">
                   <option selected disabled>Select Office</option>
                   <?php
                     $c="0";
                                          $s_i="SELECT DISTINCT `CompanyID` FROM `services_status`";
                      $r=mysqli_query($conn,$s_i);
                      while($row_c=mysqli_fetch_array($r))
                      {
                        $id=$row_c['CompanyID'];
                        $c=$c+1;
                        ?>
                        <option value="<?php echo $row_c['CompanyID']; ?>">
                        <?php echo companyname($id); ?>                                      
                        </option> 
                        <?php
                      }
                  ?>
                 </select>
               </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="userfrom">Select Services</label>
                       <select class="form-control" name="services_id"  id="servises">
                         <option selected disabled>Select Services</option>
                       </select>
                     </div>
                 </div>
                 
               </div> 

               <div class="form-group" id="servises_action">
                            
                </div> 
                <input type="hidden" name="services_type" id="services_type">                         
              <button type="submit" name="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
              <div id="output"></div>
          </div>
        </div>
      </div> 
   </div>
 <script> 
      
        $(document).ready(function(){
          let se="";
          //code for office select 
          $('#office_name').on('change',function(){
              let category =  $(this).val();
              //alert(category);
              $.ajax({
                    url:"select_services.php",
                    type:"POST",
                    data:{'request': category},
                    beforeSend:function(){
                        $("#servises").html("<span>Data is loading</span>");
                    },
                    success:function(data){
                       $("#servises").html(data);
                       //alert(data);
                    }
              });
            });

              //code for services select
            $('#servises').on('change',function(){

                let services = $('#servises').val();
                
                $.ajax({
                        url:"services_type.php",
                        type:"POST",
                        data:'request2=' + services,
                        beforeSend:function(){
                            $("#services_type").html("<span>Data is loading</span>");
                        },
                        success:function(data)
                        {                        
                          let b = data;
                          $('#services_type').val(data);
                          let c;                       
                            if (b=="month") 
                            {
                               c='<label for="services_type1">Select Services Status</label><select name="services_type1" class="form-control" id="services_type1"><option disabled="" selected="">-- Select Servises Status --</option><option value="DONE">DONE</option><option value="NOT">NOT</option></select>';
                            }
                            else
                            {
                              c='<label for="services_type2"  >Qunatity</label><input type="number" class="form-control" name="services_type2" id="services_type2" placeholder="Qunatity"/><label for="services_type2"  >Empty Qunatity</label><input type="number" class="form-control" name="services_type2" id="services_type2_empty" placeholder="Empty Qunatity"/>';
                             
                            }

                             $('#servises_action').html(c);
                        }
                  });
              });
            $('#submit').on('click',function(){

                 let office_name =$('#office_name').val();
                 let servises =$('#servises').val();
                 let services_type =$('#services_type').val();
                 let services_type1 =$('#services_type1').val();
                 let services_type2 =$('#services_type2').val();
                 let services_type2_empty=$('#services_type2_empty').val();
                 let username='<?php echo $username;?>';
                 let date =$('#date').val();
                 
                 if (office_name!=null) 
                 {
                    if (servises!=null) 
                    {
                        if (services_type=='unit')
                        {
                          if (services_type2!="") 
                          {
                             $.ajax({
                                        url:'save_order.php',
                                        type:'POST',
                                        data:{
                                          'username':username,
                                          'office_name':office_name,
                                          'servises':servises,
                                          'services_type':services_type,
                                          'services_type1':services_type1,
                                          'services_type2':services_type2,
                                          'services_type2_empty':services_type2_empty,
                                          'date':date
                                        },
                                        success:function(data)
                                        {
                                          $('#output').html(data);
                                          setTimeout(function(){
                                                location.reload();
                                              }, 1000);
                                        },
                                        error:function(error)
                                        {
                                          console.log(error);
                                        }
                                   });
                          }
                          else
                          {
                            alert('Enter Qunatity');
                          }
                        }

                        if (services_type=='month')
                        {
                           if (services_type1!=null) 
                            {
                               $.ajax({
                                          url:'save_order.php',
                                          type:'POST',
                                          data:{
                                            'username':username,
                                            'office_name':office_name,
                                            'servises':servises,
                                            'services_type':services_type,
                                            'services_type1':services_type1,
                                            'services_type2':services_type2,
                                            'date':date
                                          },
                                          success:function(data)
                                          {
                                            $('#output').html(data);
                                            setTimeout(function(){
                                                location.reload();
                                              }, 1000);
                                          },
                                          error:function(error)
                                          {
                                            console.log(error);
                                          }
                                     });
                            }
                            else
                            {
                              alert('Select Services Status');
                            }
                        }

                    }
                    else
                    {
                      alert('select servises');
                    }
                 }
                 else
                 {
                    alert('select office name');
                 }                
                 
              });
           });          
      
    </script>  
 <?php
  require 'admin_footer.php';
 ?>
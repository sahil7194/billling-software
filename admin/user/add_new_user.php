<?php 
   $page_title="Add New User";
    $page_icon='<i class="mdi mdi-account-plus menu-icon"></i>&nbsp;&nbsp';

    function staff()
     {
      require '../config.php';
       $select_query="SELECT `id`, `full_name` FROM `staff`";
              $run=mysqli_query($conn,$select_query);
              $row_count=mysqli_num_rows($run);
              if ($row_count>0)
              {
                echo '<option value="">-- Select staff --</option>';
                while ($row_data=mysqli_fetch_array($run))
                {
                  echo '<option value="'.$row_data['id'].'">'.$row_data['full_name'].'</option>';
                }
              }
              else
              {
                echo '<option value="">-- No user found --</option>';
              } 
           
     }

     function office()
     {
        require '../config.php';
       $select_query="SELECT `id`, `office_name` FROM `office_deatils` WHERE `status`='0'";
            $run=mysqli_query($conn,$select_query);
            $row_count=mysqli_num_rows($run);
            if ($row_count>0)
            {
              echo '<option value="">-- Select Office --</option>';
              while ($row_data=mysqli_fetch_array($run))
              {
                echo '<option value="'.$row_data['id'].'">'.$row_data['office_name'].'</option>';
              }
            }
            else
            {
              echo '<option value="">-- No user found --</option>';
            }
        

     }

   require '../admin_header.php';
   ?>
  <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post"> 
             <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
               <div class="form-group">
                 <label for="usertype">User Type</label>
                 <select class="form-control" id="usertype" name="usertype">
                   <option selected disabled>User Type</option>
                   <option value="staff"> Staff</option>
                   <option value="partner">Partner</option>
                   <option value="office">Office</option>
                 </select>
               </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="userfrom">User From</label>
                       <select class="form-control" id="userfrom" name="userfrom">
                         <option selected disabled>User From</option>
                         
                       </select>
                     </div>
                 </div>

               </div>
               <div class="out">
                     
                 </div>
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                        <small class="username-error" style="color: red; font-weight: bolder;"></small>
                    </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                     </div>
                 </div>
                 
               </div>
                           
              <button type="submit" name="submit" class="btn btn-primary mr-2" id="submit">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div>
   <script type="text/javascript">
      $(document).ready(function(){
          let ur="";
          $('#usertype').on('change',function(){
             let usertype=$(this).val();

             if (usertype=="staff") 
             {
               //console.log("this is staff");
               $('#userfrom').html('<?php staff()?>');
               ur="staff";       
                  let data=`<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                       <label for="price_type">Services Type</label>
                       <select class="form-control" id="services_type" name="services_type" required>
                         <option selected disabled>Select Services Type</option>
                         <option value="unit">Per Unit </option>
                        <option value="month">Per Month</option>
                       </select>
                     </div>
                 </div>`;
            
                $('.out').html(data);
                            
             }
             else if(usertype=="office")
             {
              //console.log("this user form office");
              $('#userfrom').html('<?php office()?>');
              ur="office";
             }
             else if(usertype=="partner")
             {
              //console.log("this user form partner");
              $('#userfrom').html('<option value="partner">partner</option>');                
             }
             else
             {
              $('#userfrom').html('<option value="">No user Found</option>');
             }
           
          });
          
          $('#username').on('blur',function(){
            let username=$(this).val();
            
            if (username!="") 
            {
                $.ajax({
                    url:'checkusername.php',
                    type:'POST',
                    data:{
                        username:username
                    },
                    success:function(res)
                    {
                       
                        if(res==0)
                        {
                            $('.username-error').html('');
                           // $('#submit').attr('disabled','flase');
                        }
                        else
                        {
                            $('.username-error').html('This user name already taken');
                            //$('#submit').attr('disabled','true');
                        }
                    }
                });
            }
            else
            {
                $('.username-error').html('username not be null');
            }

            });
        
                                    
      });
    </script>
   <?php
      require '../admin_footer.php';

       if (isset($_POST['submit']))
        {
          $usertype=$_POST['usertype'];
          $userfrom=$_POST['userfrom'];
          $username=$_POST['username'];
          $password=$_POST['password'];
          $services_type=$_POST['services_type'];
          if (!empty($username)&&!empty($password))
          {
             $sql_insert_user="INSERT INTO `user`(`username`, `password`, `profile`, `user_form`, `ActiveStatus`,`services_type`) VALUES ('$username','$password','$usertype','$userfrom','on','$services_type');";
             $run_insert_user=mysqli_query($conn,$sql_insert_user);
             
             if ($run_insert_user==true)
            {
                echo '<script>swal("", "user Add successfully !", "success")</script>';

            }
            else
             {
                echo '<script>swal("", "Fail to add user", "error")</script>';
            }
            
          }
        }
 ?>
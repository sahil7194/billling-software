<?php 
   $page_title="Edit User";
    $page_icon='<i class="mdi mdi-account-plus menu-icon"></i>&nbsp;&nbsp';

?>
<?php 
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
                 <select class="form-control" id="usertype">
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
                       <select class="form-control" id="userfrom">
                         <option selected disabled>User From</option>
                         <option>2</option>
                         <option>3</option>
                         <option>4</option>
                         <option>5</option>
                       </select>
                     </div>
                 </div>

               </div>
               <div class="row">
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                     </div>
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                     </div>
                 </div>
                 
               </div>
                           
              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div> 
   </div>
   <?php
      require '../admin_footer.php';

      
 ?>
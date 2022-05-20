<?php 
   $page_title="Add Purchase";
   $page_icon='<i class="mdi mdi-book-open-variant menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
       <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title?></h4>
            
            <form class="forms-sample" action="" method="post" enctype="multipart/form-data"> 
               <div class="row">
                
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                     <div class="form-group">
                        <label for="supporting_doc">Supporting Document</label>
                        <input type="file" class="form-control" id="supporting_doc" name="supporting_doc" placeholder="Office Incharge Contact No">
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
  if (isset($_POST['submit']))
   {
     $id=$_GET['id'];    
      $location="../doc/";
      $supporting_doc=$_FILES['supporting_doc'];
     $base_1=$location.basename($_FILES['supporting_doc']['name']);
    
            
            if (move_uploaded_file($_FILES['supporting_doc']['tmp_name'], $base_1))
             {
             	echo $sql_insert_purches="UPDATE `purches` SET `supporting_doc`='$base_1' WHERE `id`='$id';";
	            $run_insert_purches=mysqli_query($conn,$sql_insert_purches);

	            if ($run_insert_purches==true)
	            {                                  
	              echo '<script>swal(" ", "file upload", "success")</script>';
	            }
	            else
	            {                                  
	              echo '<script>swal(" Opps !", "Fail to save data", "error")</script>';
	            }  
             } 

             else
	            {                                  
	              echo '<script>swal(" Opps !", "Fail to save data", "error")</script>';
	            }  
    }
                          
 ?>

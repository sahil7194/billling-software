<?php 
   $page_title="Manage Supplier";
   $page_icon='<i class="mdi mdi-escalator menu-icon"></i>&nbsp;&nbsp';

?>
<?php 
   require '../admin_header.php';
   ?>
   <div class="content-wrapper">
      <div class="grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4>            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>          
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Supplier Address</th>
                    <th scope="col">Supplier Contact No</th>
                    <th scope="col">Date</th>
                    <th scope="col" align="center">Action</th>
                  </tr>
                </thead>
                  <tbody id="supplier_data">
                      <?php 
                          $count=0;
                          $table_data="SELECT `id`, `supplier_name`, `supplier_address`, `supplier_contact_no` ,`date` FROM `supplier` WHERE `status`='0'";
                          $run_data=mysqli_query($conn,$table_data);
                          while($row_table=mysqli_fetch_array($run_data))
                          {
                            $count=$count+1;
                      ?>
                      <tr>
                        <th scope="row"><?php echo $count;?></th>
                        <td><?php echo $row_table['supplier_name'] ?></td>
                        <td><?php echo $row_table['supplier_address'] ?></td>
                        <td><?php echo $row_table['supplier_contact_no'] ?></td>
                        <td><?php echo $row_table['date'] ?></td>
                        <td>
                          <a href="./edit_supplier.php?id=<?php echo $row_table['id'] ?>">
                              <span class="material-icons">edit</span>
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-danger delete" value="delete_supplier.php?id=<?php echo $row_table['id'] ?>">
                              <span class="material-icons">delete</span>
                          </button>
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
    <script type="text/javascript">
     $(document).ready(function(){
        $('.delete').on('click',function(){
            let val =$(this).val();

            let text = "Are you sure.";
            link='delete_supplier.php?id='+val;
            if (confirm(text) == true) {
              window.location.replace(link);
              } else {
              text = "You canceled!";
            }
            //console.log(link);
        });
     });
   </script>

   <?php
      require '../admin_footer.php';
 ?>
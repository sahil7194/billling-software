<?php 
   $page_title="Manage Item";
   $page_icon='<i class="mdi mdi-sitemap menu-icon"></i>&nbsp;&nbsp';
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
                        <th scope="col"># </th> 
                        <th scope="col">Supplier Name </th>
                        <th scope="col">Item </th> 
                     </tr>
                   </thead>
                   <tbody id="user_data">
                      <?php   
                        $count=0;
                        $sql_for_table_data="SELECT `id`, `supplier_name` FROM `supplier` WHERE `status`='0';";
                        
                        $run_select=mysqli_query($conn,$sql_for_table_data);
                        while ($table_row=mysqli_fetch_array($run_select))
                          {
                            $count=$count+1;
                            $supplier_id= $table_row['id'];
                            ?>                        
                          <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $table_row['supplier_name']; ?></td>
                            <td>
                            	<table class="table table-hover">
                            		<?php 	
                            		$sql_for_item="SELECT `id`, `item_name` FROM `item_data` WHERE `status`='0' AND `supplier_id`='$supplier_id';";
                            		$run_for_item=mysqli_query($conn,$sql_for_item);
                            		while ($row_for_item=mysqli_fetch_array($run_for_item))
                            		{
                            			?>
                            				<tr>
                            					<td>
                            						<?php echo $row_for_item['item_name'];?>
                            					</td>
                            					<td>
                            						<a href="./item_edit.php?supplier_id=<?php echo $supplier_id;?>&&item_id=<?php echo $row_for_item['id'];?>">
						                                <span class="material-icons">edit</span>
						                            </a>  
                                        </td>
                                        <td>                        
						                            <button class="btn btn-danger delete" id="<?php echo $supplier_id;?>" value="<?php echo $row_for_item['id'];?>">
						                                <span class="material-icons">delete</span>
						                            </button> 
                            					</td>
                            				</tr>
                            			<?php
                            		}
                            	 ?>
                            	</table>
                            	
                                                             
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
            let sup =$(this).attr('id');
            // console.log(val);
            // console.log(sup);

            let text = "Are you sure.";
            link='item_delete.php?supplier_id='+sup+'&&item_id='+val;
            if (confirm(text) == true) {
              window.location.replace(link);
              } else {
              text = "You canceled!";
            }
            console.log(link);
        });
     });
   </script>
   <?php
      require '../admin_footer.php';
 ?>
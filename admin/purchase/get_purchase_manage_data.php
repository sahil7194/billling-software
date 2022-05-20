 <?php 	
 require '../config.php';
require '../function_for_office.php';
 if (isset($_POST['month']))
 {
 	$month=$_POST['month'];
 }
  ?>
 <table class="table table-hover">
<thead>          
 <tr>                       
   <th scope="col">Supplier Name  </th>
   <th scope="col">Suppling Item</th>  
   <th scope="col">Amount</th>
    <th scope="col">Quantity</th>
   <th scope="col">Supporting Document </th> 
   <th scope="col">Date</th>
 </tr>
</thead>
<tbody id="purches_data">
  <?php   
    $c=0;
     $select_purches="SELECT `id`, `supplier_name`, `item_name`, `amount`, `supporting_doc`,DATE(`date`) as `date`,`quantity` FROM `purches` WHERE MONTH(`date`)='$month'  ORDER BY `date` ASC";
    $run_purches=mysqli_query($conn,$select_purches);
    while ($row_purches=mysqli_fetch_array($run_purches))
    {
      $c=$c+1;
      $o_date=$row_purches['date'];

    $timestamp = strtotime($o_date);

    // Creating new date format from that timestamp
    $new_date = date("d-m-Y", $timestamp);
      ?>
      <tr> 
       <td>
          <?php echo supplier_name($row_purches['supplier_name']); ?>
        </td>
         <td>
          <?php echo item_name($row_purches['item_name']); ?>
        </td>
         <td>
          <?php echo $row_purches['amount']; ?>
        </td>
        <td>
          <?php echo $row_purches['quantity']; ?>
        </td>
         <td>
          <?php 
            if ($row_purches['supporting_doc']=="../doc/") 
            {
              ?>
              <a href="upload_doc_file.php?id=<?php echo $row_purches['id']?>">
                   <i class="mdi mdi-cloud-upload"></i>
                </a>
                
              <?php
            }
            else
            {
              ?>
                <a href="<?php echo $row_purches['supporting_doc'];?>">
                  <i class="mdi mdi-file-document"></i> 

                 </a>
              <?php
            }
           ?>
            

        </td>
        <td>
          <?php echo $new_date; ?>
        </td>
      </tr>
      <?php
    }
   ?>
</tbody>     
</table>
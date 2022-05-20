<?php 
require '../config.php';
$last_billing_date='';
	if (isset($_POST['supplier_id'])) 
	{
		$supplier_id=$_POST['supplier_id'];
		$today=date('Y-m-d');
		$sql_1="SELECT `last_billing_date` FROM `supplier` WHERE `id`='$supplier_id';";
		$run_1=mysqli_query($conn,$sql_1);
		while ($row_1=mysqli_fetch_array($run_1))
		{
			$last_billing_date=$row_1['last_billing_date'];
		}
$min_date;
		if($last_billing_date!="")
		{
			$min_date=$last_billing_date;
		}
		else
		{
			$sql_2="SELECT DATE (MIN(`date`)) AS `min_date` FROM `purches` WHERE `supplier_name`='$supplier_id'";
			$run_2=mysqli_query($conn,$sql_2);
			while ($row_2=mysqli_fetch_array($run_2)) 
			{
				$min_date=$row_2['min_date'];
			}
		}
		?>
			<div class="row mt-3">
             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                 <div class="form-group">
                    <label for="amount">Form</label>
                    <input type="date" name="form_date" id="form_date"min="<?php echo $min_date;?>" max="<?php echo $today;?>" class="form-control">
                 </div>
             </div>

             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                 <div class="form-group">
                    <label for="supporting_doc">To</label>
                    <input type="date" name="to_date" id="to_date" min="<?php echo $min_date;?>"max="<?php echo $today;?>" class="form-control">
                 </div>
             </div>

             <button class="btn btn-primary" id="check_invoice">
             	check invoice 
             </button>
            
             <script type="text/javascript">
             	$(document).ready(function(){
             		$('#check_invoice').on('click',function(){
             			supplier_id='<?php echo $supplier_id;?>';
             			form_date=$('#form_date').val();
             			to_date=$('#to_date').val();

             			if (form_date!=""&&to_date!="")
             			 {
             			 	$.ajax({
             			 		url:'view_purchase_invoice.php',
             			 		type:'POST',
             			 		data:{
             			 			supplier_id:supplier_id,
									form_date:form_date,
									to_date:to_date
             			 		},
             			 		success:function(res)
             			 		{
             			 			$('.output').html(res);
             			 		}
             			 	});
             			 }
             			 else
             			 {
             			 	alert('Select Date');
             			 }
             		});
             	});
             </script>
		<?php 
	}

?>
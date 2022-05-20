<?php 

 require '../config.php';

 function full_name($id)
    {
      require '../config.php';

      $staff="SELECT `id`, `full_name`  FROM `staff` WHERE `id`='$id';";
      $run=mysqli_query($conn,$staff);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['full_name'];
      }

      return $name;
    }

    function month($month_id)
    {
      $month_name;
      switch($month_id)
      {
        case '1':    
        $month_name="Janaury";
        break;

        case '2':    
        $month_name="February";
        break;

        case '3':    
        $month_name="March";
        break;

        case '4':    
        $month_name="April";
        break;

        case '5':    
        $month_name="May";
        break;

        case '6':    
        $month_name="June";
        break;

        case '7':    
        $month_name="July";
        break;

        case '8':    
        $month_name="August";
        break;

        case '9':    
        $month_name="September";
        break;

        case '10':    
        $month_name="October";
        break;

        case '11':    
        $month_name="November";
        break;

        case '12':    
        $month_name="December";
        break;

      }

      return $month_name;
    }
  ?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>staff info</title>
	<style type="text/css">
		/*#print_content
		{
			margin-top: 140px;
			margin-left: 60px;
			margin-right: 60px;
		}*/
	</style>
</head>
<body>
	<div id="print_content" style="margin-top:140px; padding-left: 80px; padding-right: 50px;">
	<table width="100%" >
		<?php   
          $id=$_GET['id'];
            $select_staff="SELECT `id`, `full_name`, `mobile_no`, `pass_photo`, `current_address`, `current_address_file`, `permanet_address`, `permanet_address_file`, `addhar_card_no`, `addhar_card_file`, `pan_card_no`, `pan_card_file`,DATE(`date`) as `date`,`salary_amunt` FROM `staff` WHERE `id`='$id'";
            $run=mysqli_query($conn,$select_staff);
            while ($row_staff=mysqli_fetch_array($run))
            {

         ?>
        
         	<tr>
         		<td>
         			
         		</td>
         	<td width="30%" rowspan="1">
         		<div style="border:1px solid black; margin-top:40px; height: 150px; width:150px;">
         			
         		</div>
         	</td>
             </tr> 
             <tr>
             	<td width="">
             		<table width="100%" border="0">
             			<tr>
             				<td width="30%">
             					Full Name
             				</td>
             				<td>
             					<?php echo $row_staff['full_name'];?>
             				</td>
             			</tr>
             			<tr>	
             				<td>
             					Mobile No.
             				</td>
             				<td>
             					<?php echo $row_staff['mobile_no'];?>
             				</td>
             			</tr>
             			  <tr>	
             				<td>
             					Current Address
             				</td>
             				<td>
             					<?php echo $row_staff['current_address'];?>
             				</td>
             			</tr>
             			 <tr>	
             				<td>
             					Permanent Address
             				</td>
             				<td>
             					<?php echo $row_staff['permanet_address'];?>
             				</td>
             			</tr>
             			        			<tr>	
             				<td>
             					Addhar Card
             				</td>
             				<td>
             					<?php echo $row_staff['addhar_card_no'];?>
             				</td>
             			</tr>	
             			        			<tr>	
             				<td>
             					Pan Card
             				</td>
             				<td>
             					<?php echo $row_staff['pan_card_no'];?>
             				</td>
             			</tr>
            			        			<tr>	
             				<td>
             					Salary Amount
             				</td>
             				<td>
             					<?php echo $row_staff['salary_amunt'];?>
             					
             				</td>
             			</tr>
             			<tr>
             				<td>
             					Date of Join
             				</td>
             				<td>
             					<?php echo $row_staff['date'];?>
             				</td>
             			</tr>
             		</table>
             	</td>
             </tr>    
		  <?php 
		     }
		     ?>
	</table>
</div>
	<input type="button" onclick="print_me()" id="create_pdf" value="Print" class="m-2"> 
<script type="text/javascript">
    	function print_me()
            {
                var content = document.getElementById('print_content').innerHTML;
                var win = window.open();
                win.document.write(content);
                win.print();
                win.close();
            }
    </script>
</body>
</html>
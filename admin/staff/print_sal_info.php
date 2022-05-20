
<?php 

 require '../config.php';
 $id=$_GET['id'];

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

    function mobile_number($id)
    {
    	require '../config.php';

      $staff="SELECT `id`, `mobile_no`  FROM `staff` WHERE `id`='$id';";
      $run=mysqli_query($conn,$staff);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['mobile_no'];
      }

      return $name;

    }

    function current_address($id)
	{
		require '../config.php';

      $staff="SELECT `id`, `current_address`  FROM `staff` WHERE `id`='$id';";
      $run=mysqli_query($conn,$staff);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['current_address'];
      }

      return $name;

	}

	function total_advance($id,$month)
	{
		require '../config.php';

      $staff="SELECT SUM(`amount`)as `amt` FROM `advances` WHERE `staff_id`='$id' AND MONTH(`date`)='$month'";
      $run=mysqli_query($conn,$staff);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['amt'];
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

function convert_amount_in_indain_cur_in_word($number)
 {
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  //return $result . "Rupees  " . $points . " Paise";

  return $result . "Rupees  ";
 }

function company_for_gst_status($comapny_id)
{
  require '../config.php';
    $sql="SELECT `GstNO` FROM `office_deatils` WHERE `id`='$comapny_id';";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run)) 
    {
      $gst_status=$row['GstNO'];
    }

    if ($gst_status!="") 
    {
      return true;
    }
    else
    {
      return false;
    }
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
<div id="print_content">
	<table width="100%">
		<tr>
			<td colspan="2" align="center">
				Salary Details
			</td>
		</tr>
		<?php 	
			$sql_f="SELECT `staff_id`, `payment_mode`, `amount`, `month`, `note` FROM `salary` WHERE `id`='$id';";
			$run_f=mysqli_query($conn,$sql_f);
			while ($row_f=mysqli_fetch_array($run_f)) 
			{
				?>
				<tr>
					<td width="20%">
						Name
					</td>
					<td>
						<?php echo full_name($row_f['staff_id']); ?>
					</td>
				</tr>
				<tr>
					<td width="20%">
						Mobile Number
					</td>
					<td>
						<?php echo mobile_number($row_f['staff_id']); ?>
					</td>
				</tr>

				<tr>
					<td width="20%">
						Current Address 
					</td>
					<td>
						<?php echo current_address($row_f['staff_id']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Advances
					</td>
					<td>
						<?php echo total_advance($row_f['staff_id'],$row_f['month']) ?>
					</td>
				</tr>


								<tr>
					<td>
						Salary Amount
					</td>
					<td>
						<?php echo $row_f['amount']; ?>
					</td>
				</tr>
				<tr>
					<td>
						Payment Mode
					</td>
					<td>
						<?php echo $row_f['payment_mode']; ?>
					</td>
				</tr>

				<tr>
					<td>
						Month
					</td>
					<td>
						<?php echo month($row_f['month']); ?>
					</td>
				</tr>
				<tr>
					<td>
						Note
					</td>
					<td>
						<?php echo $row_f['note']; ?>
					</td>
								<tr>
					<td>
						Salary Amount
					</td>
					<td>
						<?php echo ucwords(convert_amount_in_indain_cur_in_word($row_f['amount'])).'Only /-'; ?>
					</td>
				</tr>
				</tr>
								<tr>
					<td>
						
					</td>
					<td>
						<div style="height: 70px; width:200px; margin-top: 50px; border: 1px solid black;">
							
						</div>
						Recived Sign
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
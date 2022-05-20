<?php
//function for getting client name 
function clientname($i)
  {
    require '../config.php';
    $select="SELECT `id`, `office_name`, `office_owner_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$i'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo $client_name=$row['office_name'];
      
    }
  }
  //function for getting client information
  function clientDetails($i)
  {
    require '../config.php';
    $select="SELECT `id`, `office_name`, `office_owner_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$i'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo "<strong>".$client_name=$row['office_name']."</strong>";
      echo "<br>".$clinet_address=$row['office_address'];
    }
  }
  function companydetails($id)
  {
    require '../config.php';
    $select="SELECT `id`, `client_name`, `address`, `client_contact_no`, `gst_no`, `client_logo`, `date` FROM `configuration` WHERE `id`='$id'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo "<br><strong>".$client_name=$row['client_name']."</strong>";
      echo "<br> ".$company_address=$row['address'];
      echo "<br>GST No :-  ".$gst_no=$row['gst_no'];
      echo "<br>Contact No :- ".$contact_no=$row['client_contact_no'];
    }
  }
  function ownername($id)
  {
    require '../config.php';
    $select="SELECT `id`, `office_name`, `office_owner_name`, `office_address`, `office_contact_no`, `GstNO`, `Email`, `office_incharge`, `office_incharge_contact_no`, `date` FROM `office_deatils` WHERE `id`='$id'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo "<br><strong>".$client_name=$row['office_owner_name']."</strong>";
    }
  }
  function companyname($id)
  {
    require '../config.php';
    $select="SELECT `client_name` FROM `configuration` WHERE `id`='$id'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo "<strong>".$client_name=$row['client_name']."</strong>";
    }
  }

  function check_gst($id)
  {
      require '../config.php';
      $sql="SELECT  `GstNO` FROM `office_deatils` WHERE `id`=$id;";
      $run=mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_array($run))
      {
        $gst_no=$row['GstNO'];
      }

      if ($gst_no=='NO') 
      {
        $gst_no='';
      }
      elseif ($gst_no=='no')
     {
        $gst_no='';
      }
      elseif ($gst_no=='No')
     {
        $gst_no='';
      }
      return $gst_no;
  }

  
    function companyaddres($companyid)
    {
      require '../config.php';

      $select="SELECT `office_address` FROM `office_deatils` WHERE `id`='$companyid'";
      $run=mysqli_query($conn,$select);
      while ($row=mysqli_fetch_array($run))
      {
        $name=$row['office_address'];
      }

      return $name;
    }

    function supplier_name($id)
    {

       require '../config.php';
       $select="SELECT  `supplier_name` FROM `supplier` WHERE `id`='$id';";
       $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $supplier_name=$row['supplier_name'];
        }

        echo $supplier_name;
    }


    function item_name($id)
    {
        require '../config.php';

        $select="SELECT `item_name` FROM `item_data` WHERE `id`='$id';";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $name=$row['item_name'];
        }

        return $name;
    }

    function user_count_staff()
    {
      
        require '../config.php';

        $select="SELECT COUNT(`id`)as `count` FROM `user` WHERE `profile`='staff'";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['count'];
        }

       if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
    }

    function user_count_office()
    {
      
        require '../config.php';

        $select="SELECT COUNT(`id`)as `count` FROM `user` WHERE `profile`='office'";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['count'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
    }

    function user_count_partner()
    {
      
        require '../config.php';

        $select="SELECT COUNT(`id`)as `count` FROM `user` WHERE `profile`='partner'";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['count'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
    }


    function sells_total_amount_sum()
    {
      require '../config.php';

        $select="SELECT SUM(`total_amount`) as `total` FROM `sells_invoice_data`";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

       if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
    }

    function sells_paid_amount_sum()
    {
      require '../config.php';

        $select="SELECT SUM(`paid_amount`) as `total` FROM `sells_invoice_data`";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }    }



    function purches_total_amount_sum()
    {
      require '../config.php';

        $select="SELECT SUM(`total_amount`) as `total` FROM `purches_invoice`";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

       if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }    }

    function purches_paid_amount_sum()
    {
      require '../config.php';

        $select="SELECT SUM(`paid_amount`) as `total` FROM `purches_invoice`";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
    }

function sells_total_amount_sum_for_gst()
    {
      require '../config.php';

        $select="SELECT SUM(`total_amount`) as `total` FROM `sells_invoice_data` WHERE `gst_status`='1'";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
    }

    function sells_paid_amount_sum_for_gst()
    {
      require '../config.php';

        $select="SELECT SUM(`paid_amount`) as `total` FROM `sells_invoice_data` WHERE `gst_status`='1'";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }        
    }

    function total_qunatity_by_services_id_q($id)
    {

      require 'config.php';

        $select="SELECT SUM(`Quantity`)as `total` FROM `dailystatusforunit` WHERE `SeerviceId`='$id' AND DATE(`Date`)='$today';";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
      
    }

    function total_qunatity_by_services_id_emtq($id)
    {

      require 'config.php';

        $select="SELECT SUM(`empty_quantity`)as `total` FROM `dailystatusforunit` WHERE `SeerviceId`='$id' AND DATE(`Date`)='$today'";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
      
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

function total_qunatity_by_services_id_q_month($id,$month,$year)
    {

      require 'config.php';

        $select="SELECT SUM(`Quantity`)as `total` FROM `dailystatusforunit` WHERE `SeerviceId`='$id' AND Month(`Date`)='$month' AND YEAR(`Date`)='$year';";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
        
        // return $select;
      
    }

    function total_qunatity_by_services_id_emtq_month($id,$month,$year)
    {

      require 'config.php';

        $select="SELECT SUM(`empty_quantity`)as `total` FROM `dailystatusforunit` WHERE `SeerviceId`='$id' AND Month(`Date`)='$month' AND YEAR(`Date`)='$year';";
        $run=mysqli_query($conn,$select);
        while ($row=mysqli_fetch_array($run))
        {
          $count=$row['total'];
        }

        if ($count!="") 
        {
          return $count;
        }
        else
        {
          return 0;
        }
      
    }

    function servicesname($servicesid)
  {
    require 'config.php';

    $select="SELECT `service_name` FROM `services` WHERE `id`='$servicesid'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      $name=$row['service_name'];
    }

    return $name;
  } 


?>
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
    $select="SELECT `id`, `client_name`, `address`, `client_contact_no`, `gst_no`, `client_logo`, `date` FROM `configuration` WHERE `id`='$id'";
    $run=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_array($run))
    {
      echo "<strong>".$client_name=$row['client_name']."</strong>";
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

  function user_form_data($username,$password)
  {
    require '../config.php';
    $sql="SELECT `user_form` FROM `user` WHERE `username`='$username' AND `password`='$password';";
    $run=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($run))
    {
      $id=$row['user_form'];
    }

    return $id;
  }
?>
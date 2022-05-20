<?php 
error_reporting('0');
require 'config.php';

  if (isset($_POST['office_name'])) {
    $office_name=$_POST['office_name'];
    $servises=$_POST['servises'];
    $services_type=$_POST['services_type'];
    $services_type1=$_POST['services_type1'];
    $services_type2=$_POST['services_type2'];
    $services_type2_empty=$_POST['services_type2_empty'];
    $username=$_POST['username'];
    //$today=date('d-m-Y');
    $date_1=$_POST['date']; 
    $timestamp = strtotime($date_1);

    $date = date("d-m-Y", $timestamp);

    $time= date('h:i:s a');
    if ($services_type=='unit') 
    {
      $insert_daily_data="INSERT INTO `dailystatusforunit`(`Office_id`, `SeerviceId`, `Quantity`, `Date`,`doneby`,`time`,`empty_quantity`) VALUES ('$office_name','$servises','$services_type2','$date','$username','$time','$services_type2_empty');";
      $run_daily_data=mysqli_query($conn,$insert_daily_data);
      if ($run_daily_data) 
      {
        echo '<script>swal("", "Data Save", "success")</script>';
      }
      else
      {
        echo '<script>swal("", "Fail to add", "error")</script>';
      }
    }

    if ($services_type=='month') 
    {
      //check services for month
      $insert_month_data="INSERT INTO `dailystatusformonth`(`Office_id`, `SeerviceId`, `ServicesStatus`, `Date`, `doneby`,`time`) VALUES ('$office_name','$servises','$services_type1','$date','$username','$time')";

      $run_month_data=mysqli_query($conn,$insert_month_data);
      if ($run_month_data) 
      {
        echo '<script>swal("", "Data Save", "success")</script>';
      }
      else
      {
        echo '<script>swal("", "Fail to add", "error")</script>';
      }

    }
  }
 ?>
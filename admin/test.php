 <?php 
    for ($i=1; $i <32 ; $i++) 
    { 
        if ($i%2==0) 
        {
            $q="10";
            $em=10;
            $status="DONE";
        }
        else
        {
            $q=5;
            $em=5;
            $status="NOT";
        }
        if ($i<10) 
        {
            $day="0".$i;
        }
        else
        {
            $day=$i;
        }

        // echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('6', '3', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";

        //   echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('2', '4', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";


        //     echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('1', '5', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";

        //   echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('1', '2', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";


        //     echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('5', '6', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";

        //   echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('5', '2', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";


        //     echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('4', '2', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";

        //   echo "<br>";
        //  echo  $sql="INSERT INTO `dailystatusforunit` (`Office_id`, `SeerviceId`, `Quantity`, `empty_quantity`, `status`, `doneby`, `Date`, `Time`) VALUES ('4', '5', '".$q."',".$em.", 0, 'mahadev', '2022-03-".$day."', '01:13:36 am');";



        //for month services data
        echo "<br>";
        echo $sql="INSERT INTO `dailystatusformonth` (`Office_id`, `SeerviceId`, `ServicesStatus`, `Date`, `Time`, `update_at`, `doneby`, `status`) VALUES('1', '1', '".$status."', '2022-03-".$day."', '09:17:14 am', NULL, 'vishal', 0);";

        echo "<br>";
        echo $sql="INSERT INTO `dailystatusformonth` (`Office_id`, `SeerviceId`, `ServicesStatus`, `Date`, `Time`, `update_at`, `doneby`, `status`) VALUES('6', '1', '".$status."', '2022-03-".$day."', '09:17:14 am', NULL, 'vishal', 0);";

        echo "<br>";
        echo $sql="INSERT INTO `dailystatusformonth` (`Office_id`, `SeerviceId`, `ServicesStatus`, `Date`, `Time`, `update_at`, `doneby`, `status`) VALUES('5', '1', '".$status."', '2022-03-".$day."', '09:17:14 am', NULL, 'vishal', 0);";

        echo "<br>";
        echo $sql="INSERT INTO `dailystatusformonth` (`Office_id`, `SeerviceId`, `ServicesStatus`, `Date`, `Time`, `update_at`, `doneby`, `status`) VALUES('2', '1', '".$status."', '2022-03-".$day."', '09:17:14 am', NULL, 'vishal', 0);";
    }
   

   ?>
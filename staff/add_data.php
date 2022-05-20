<?php 
	echo "<h1>Insert for daily</h1>";

	for ($i=1; $i < 32; $i++)
	{ 
		echo "<br>";
		echo "INSERT INTO `dailystatusformonth`(`Office_id`, `SeerviceId`, `ServicesStatus`, `Date`, `doneby`,`time`) VALUES ('19','13','done','2022-03-".$i."','staff','09-29-AM');";
	}

?>
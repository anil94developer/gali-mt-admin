<?php 
include("config.php");
date_default_timezone_set('Asia/Kolkata');
$usrId     = $_POST['user_id'];
     
  if($usrId == ''){
	  
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error Plaese Fill All Details"; 
		 echo (json_encode($rows));
		 exit;
  }else{
     //$res=mysqli_query($conn, "SELECT * FROM inbox WHERE NOT FIND_IN_SET('$usrId',user_id)");
     //$count = mysqli_num_rows($res);
	 $rows['success'] = "1";
	 $rows['message'] = "Notification count";
	 $rows['count'] = 0;
		 
  }
echo (json_encode($rows));



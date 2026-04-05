<?php 
include("config.php");
mysqli_set_charset($conn, 'utf8');
date_default_timezone_set('Asia/Kolkata');
$usrId     = $_POST['user_id'];
     
  if($usrId == ''){
	  
	   
	 	 $rows['success'] = "0";
		 $rows['message'] = "Error Plaese Fill All Details"; 
		 echo (json_encode($rows));
		 exit;
  }else{
	  
  
         $days_ago = date('Y-m-d', strtotime('-3 days', strtotime(date('d-m-Y'))));
		 //$res=mysqli_query($conn, "DELETE  FROM `point_table` WHERE DATE('created_at') < '".$days_ago."' and tr_nature='TRGAME001' and user_id='".$usrId."'");
         $rows['success'] = "1";
         $rows['message'] = "cleared Succesfully";

}
  
echo (json_encode($rows));



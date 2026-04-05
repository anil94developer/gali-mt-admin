<?php 
include("config.php");

$user = $_REQUEST['user_id'];
$pass_old =  $_REQUEST['old_pass'];
$pass_new =  $_REQUEST['new_pass'];

date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("d-m-Y", $timestamp);
$current_date = date("d-m-Y", $timestamp);
$current_time = date("h:i", $timestamp);
$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600; 



if($user == ''){

         $rows['success'] = '4';
		 $rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system' ; 
		 echo (json_encode($rows));
		 exit; 
		 
}else{
	
$chk_user=mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='".$user."' AND  user_status = '1'");	 
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);
if($count_chk_user > 0){


     $user_old_pss = $row_chk_user['us_pass'];  
     if($pass_old == $user_old_pss){
  
     $sqlupdtpss = "UPDATE `us_reg_tbl` SET `us_pass` = '".$pass_new."' WHERE user_id ='".$user."' AND user_status = '1'";
     $resupdtpss = mysqli_query($conn,$sqlupdtpss);
	  if($resupdtpss){
	 $rows['success'] = '1';
	 $rows['message'] = 'Password Update successfully';
	 $rows['updated_pass'] = $pass_new; 
	 echo (json_encode($rows));
	 exit;
	  }else{
	  $rows['success'] = '4';
	 $rows['message'] = 'Something went wrong please try again';
	 echo (json_encode($rows));
	 exit;
	  }
  ///run query for update pass
  }else{
	 $rows['success'] = '3';
	 $rows['message'] = 'Password Does Not Match Please Confirm Again';
	 echo (json_encode($rows));
	 exit;
  
  }
  
  }else{
  $rows['success'] = '4';
 $rows['message'] = 'Something went wrong please try again';
 echo (json_encode($rows));
 exit;
  
  }
  
 
  


}

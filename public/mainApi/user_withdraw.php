<?php 
include("config.php");

$user = $_POST['user_id'];
//$keyword = $_POST['keyword'];

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

         $rows['success'] = '0';
		 $rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system' ; 
		 echo (json_encode($rows));
		 exit; 
		 
}else{
	
	$chk_user=mysqli_query($conn, "SELECT bank_name,id,account_holder,account_no,ifsc FROM user_withdraw WHERE user_id ='".$user."'");
    $arrayList=array();
	while($row = mysqli_fetch_assoc($chk_user))
	{
		$array=array();
		$array['id']=$row['id'];
		$array['bank_name']=$row['bank_name'];
		//$array['account_holder']=$row['bank_name'];
		//$array['account_no']=$row['bank_name'];
		//$array['ifsc']=$row['bank_name'];
		$arrayList[]=$array;
		
	}
         $rows['success'] = '1';
		 $rows['message'] = 'List of Account' ;
		 $rows['data'] = $arrayList;
		 
		 echo (json_encode($rows));
		 exit;

}

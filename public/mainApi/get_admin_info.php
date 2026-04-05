<?php 
include("config.php");
 
 
 
$tbl_code = $GET_['tbl_code'];



    $rows['success'] = 1;
	$rows['data']['email'] = '+91-000000000';
	$rows['data']['phone'] = '+91000000000';
	$rows['data']['mindeposit'] = '500';
	$rows['data']['minwithdrawal'] = '1000';
	$rows['data']['maxwithdrawal'] = '100000';
    $rows['data']['whatsapp'] = '+91000000000';
	$rows['data']['news_title'] = 'PLAY ONLINE MK MATKA... THE GAME OF TRUST AND BELIEVE';
	$rows['data']['news_data'] = 'Minimum Deposit 500 Minimum Withdrawal 1000'; 
	
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



if($tbl_code == ''){

echo 'Insert Some Data';
}else{




$start = strtotime("01");
$mins = range(01,100); //Measured in seconds.
foreach($mins AS $min) {




// 
//  $time = date('H:i:s',$start+$min);
//  $time_show = date('h:i A',$start+$min);
 
 
 
 if($min < 10){
 
  echo '0'.$min."<br>";

 }else if(9 < 99){
  echo $min."<br>";

 }
else if ($min < 99){
 echo '00'."<br>";         
} 


$insertSql = "INSERT INTO `num_tbl_test`(`tbl_code`, `num`, `status`) VALUES ('$tbl_code','$min' ,'1')";

$res = mysqli_query($conn,$insertSql);

                                              

}
}


 
//echo (json_encode($rows));
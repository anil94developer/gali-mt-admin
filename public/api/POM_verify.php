<?php
include("POM_config.php");

session_start();

date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("d-m-Y", $timestamp);
$current_date = date("d-m-Y", $timestamp);
$CounterTime = date("h:i", $timestamp);
$CounterTimeTo = date("h:i", $timestamp);
$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600;
$userid = $_POST['userid'];
$orderamount = $_POST['amount'];
$order_id = $_POST['order_id'];
$transactionRef = $_POST['transactionRef'];
$date = date("d-m-Y", $timestamp);
$date_time = date("d-m-Y h:i", $timestamp);
$created_at = date("Y-m-d H:i:s", $timestamp);

$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '" . $userid . "'");

while ($row = mysqli_fetch_assoc($sql)) {
	$newcoins = $row['credit'] + $orderamount;
	$bonus = $row['bonus_diamonds'] + 10;
}
// $insertq =mysqli_query($conn,"update payment set status='Success',trnsid='".$payid."' WHERE uid='".$userid."' and orderid='".$order_id."' ");

$insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transaction_id`, `transactionRef`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`created_at`) VALUES ('com.dubaiking','$userid','$order_id','$transactionRef','TRDEPO002','$orderamount','$newcoins','Deposit','Credit','com.dubaiking','$date','$date_time','Online','Pending','0',' ','','ADMIN0001','$created_at')";
mysqli_query($conn, $insertData1);

// $updateBalance = "UPDATE us_reg_tbl SET credit = '$newcoins' Where user_id = '".$userid."' AND app_id = 'com.dubaiking'";           		
// mysqli_query($conn,$updateBalance);

echo json_encode(['status' => 1, 'message' => 'Successfully']);
$conn->close();
?>
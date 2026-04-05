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
$paymentRequestId = $_POST['paymentRequestId'];
$tr_status = $_POST['tr_status'];
// echo $paymentRequestId;die;
$date = date("d-m-Y", $timestamp);
$date_time = date("d-m-Y h:i", $timestamp);
$created_at = date("Y-m-d H:i:s", $timestamp);

if ($_POST['userid'] == '' || $_POST['paymentRequestId'] == '') {
	echo json_encode(['status' => 0, 'message' => 'Somthing went wrong !!']);
} else {
	$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '" . $userid . "'");

	while ($row = mysqli_fetch_assoc($sql)) {
		$newcoins = $row['credit'] + $orderamount;
		// dd($newcoins);
		$bonus = $row['bonus_diamonds'] + 10;
	}
	// echo $tr_status.$paymentRequestId.$transactionRef.$order_id.$orderamount; die;
	$sql1 = mysqli_query($conn, "SELECT * FROM point_table WHERE user_id = '$userid' AND paymentRequestId = '$paymentRequestId'");
	$count = mysqli_fetch_assoc($sql1);

	// echo $count['paymentRequestId']; die;

	if ($count['paymentRequestId'] == $paymentRequestId) {
		$update = "UPDATE `point_table` SET `transactionRef`='$transactionRef',`tr_status`='$tr_status',`transaction_id`='$order_id' WHERE `paymentRequestId`='$paymentRequestId'";
		mysqli_query($conn, $update);

		// $insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transaction_id`, `transactionRef`,`paymentRequestId`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`created_at`) VALUES ('com.dubaiking','$userid','$order_id','$transactionRef','$paymentRequestId','TRDEPO002','$orderamount','$newcoins','Deposit','Credit','com.dubaiking','$date','$date_time','Online','Pending','0',' ','','ADMIN0001','$created_at')";
		// mysqli_query($conn, $insertData1);

		echo json_encode(['status' => 1, 'message' => 'Successfully']);
		$conn->close();
	} else {
		echo json_encode(['status' => 0, 'message' => 'Please check Payment Request Id']);
		$conn->close();
	}
}

?>
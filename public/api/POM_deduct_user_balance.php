<?php
require('POM_config.php');

$orderId = $_POST["orderId"];
$orderAmount = $_POST["orderAmount"];
$referenceId = $_POST["referenceId"];
$txStatus = $_POST["txStatus"];
$paymentMode = $_POST["paymentMode"];
$txMsg = $_POST["txMsg"];
$upiID = $_POST["get_id"];
$Token = $_POST["token"];
$userID = $_POST["user_id"];
$auth = $_POST["auth"];
$devName = $_POST["device_name"];
$devType = $_POST["device_type"];
$cod = $_POST["auth_code"];
$devId = $_POST["device_id"];

$userBal = 0;

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


if ($userID == '' || $Token == '' || $upiID == '') {

	$rows['status'] = '3';
	$rows['message'] = "You are anothrised access do not try more we will block your id and device permantly";

} else {

	$userCheck = mysqli_query($conn, "SELECT * FROM us_reg_tbl Where user_id = '" . $userID . "' AND app_id = '" . $Token . "'  AND user_status = '1'");
	$userNum = mysqli_num_rows($userCheck);
	$userData = mysqli_fetch_assoc($userCheck);

	$userBal = $userData['credit'];

	if ($userNum > 0) {

		if ($cod == 'SUCCESS') {
			$UpdatedBalance = $userBal + $orderAmount;

			$insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`) VALUES ('$Token','$userID','$referenceId','TRDEPO002','$orderAmount','$UpdatedBalance','Deposit','Credit','$devName','$date','$date_time','Online','Success','0',' $devType','$devId','ADMIN0001')";
			mysqli_query($conn, $insertData1);

			$updateBalance = "UPDATE us_reg_tbl SET credit = '$UpdatedBalance' Where user_id = '" . $userID . "' AND app_id = '" . $Token . "'";
			mysqli_query($conn, $updateBalance);

			$rows['status'] = '1';
			$rows['message'] = $txMsg;

		} else {
			///all payment process without success data here 
			$insertData3 = "INSERT INTO `usercoin`(`user_id`, `money`, `transStatus`, `upiId`, `TranID`, `TDate`) VALUES ('$userID', '$orderAmount','$txStatus','$upiID','$orderId', '$date_time')";
			mysqli_query($conn, $insertData3);

			$rows['status'] = '2';
			$rows['message'] = $txMsg;
		}
	} else {
		$rows['status'] = '0';
		$rows['message'] = "You are anothrised access or User does not exits or blocked" . $userCheck;
	}
}
echo (json_encode($rows));
$conn->close();
?>
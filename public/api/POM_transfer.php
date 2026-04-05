<?php

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With");

require('POM_config.php');
$amount = $_POST["amount"];
$userid = $_POST["user_id"];
$rec_mob = $_POST["rec_mob"];
$devName = $_POST["devName"];
$appId = $_POST["app_id"];
$order_id = rand(123, 999) . rand(999, 111);
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
$comm = mysqli_query($conn, "SELECT transfer_min,transfer_max FROM app_controller");
$comm = mysqli_fetch_assoc($comm);

if ($userid == '' || $rec_mob == '' || $devName == '') {
	$rows['status'] = '0';
	$rows['message'] = "You are anothrised access do not try more we will block your id and device permantly";
} else {

	$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE mob = '" . $rec_mob . "'");
	$rcheck = mysqli_num_rows($sql);
	if ($rcheck) {

		if ($amount >= $comm['transfer_min'] and $amount <= $comm['transfer_max']) {
			$row = mysqli_fetch_assoc($sql);
			$rec_id = $row['user_id'];
			$sql1 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id = '" . $userid . "'");
			$row1 = mysqli_fetch_assoc($sql1);
			if ($row1['win_amount'] < $amount) {
				$rows['status'] = '0';
				$rows['message'] = "Amount is low";
				return(json_encode($rows));
				$conn->close();
			}
			$new = $row1['win_amount'] - $amount;
			$newsenderCoin = ($row1['win_amount'] + $row1['credit']) - $amount;
			$smob = $row1['mob'];
			$newcoins = $row['win_amount'] + $amount;
			$ccoins = ($row['win_amount'] + $row['credit']) + $amount;
			$devType = '';
			$insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transfer_user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`is_transfer`,`t_mob`) VALUES ('$appId','$rec_id','$userid','$order_id','TRDEPO002','$amount','$ccoins','Deposit','Credit','$devName','$date','$date_time','transfer','Success','0',' $devType','','ADMIN0001','1','$smob')";
			mysqli_query($conn, $insertData1);

			$sql12 = "INSERT INTO `wallet_reports`(`transaction_id`,`value_update_by`,`is_transfer`,`type`, `user_id`,`transfer_user_id`,`app_id`,`tr_nature`,`tr_value`,`tr_value_updated`, `date`,`date_time`,`tr_status`,`tr_remark`)
	       VALUES ('$order_id','Transfer','1','Credit','$rec_id','$userid','$appId','TRDEPO002', '$amount','$ccoins','$date', '$date_time', 'Success','From-$smob')";
			mysqli_query($conn, $sql12);

			$updateBalance = "UPDATE us_reg_tbl SET win_amount = '$newcoins' Where user_id = '" . $rec_id . "' AND app_id = '" . $appId . "'";
			mysqli_query($conn, $updateBalance);

			$insertData12 = "INSERT INTO `point_table`( `app_id`, `user_id`,`transfer_user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`,`is_transfer`,`t_mob`) VALUES ('$appId','$userid','$rec_id','$order_id','TRWITH003','$amount','$newsenderCoin','Withdraw','Debit','$devName','$date','$date_time','transfer','Success','0',' $devType','','ADMIN0001','1','$rec_mob')";
			mysqli_query($conn, $insertData12);

			$sql121 = "INSERT INTO `wallet_reports`(`transaction_id`,`value_update_by`,`is_transfer`,`type`, `user_id`,`transfer_user_id`,`app_id`,`tr_nature`, `tr_value`,`tr_value_updated`,  `date`, `date_time`,`tr_status`,`tr_remark`)
	       VALUES ('$order_id','Transfer','1','Debit','$userid','$rec_id','$appId','TRWITH003', '$amount','$newsenderCoin','$date', '$date_time', 'Success','To-$rec_mob') ";
			mysqli_query($conn, $sql121);

			$updateBalance = "UPDATE us_reg_tbl SET win_amount = '$new' Where user_id = '" . $userid . "' AND app_id = '" . $appId . "'";
			mysqli_query($conn, $updateBalance);
			$rows['status'] = '1';
			$rows['message'] = "Amount has been transferred successfully";
		} else {
			$rows['status'] = '0';
			$rows['message'] = "You can transfer Minimum " . $comm['transfer_min'] . " and Maximum " . $comm['transfer_max'];
		}
	} else {
		$rows['status'] = '0';
		$rows['message'] = "Receiver account does not exists";
	}
}
echo (json_encode($rows));
$conn->close();
$conn->close();
$conn->close();
$conn->close();

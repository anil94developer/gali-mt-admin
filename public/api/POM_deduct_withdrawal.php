<?php
// echo "ddddd"; die;
include("POM_config.php");
date_default_timezone_set('Asia/Kolkata');
$user = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
$bal_req = $_POST['point'];
$otp = $_POST['otp'];
$req_message = $_POST['message'];
$account_number = str_replace(' ', '', $_POST['account_number']);
$ifsc_code = str_replace(' ', '', $_POST['ifsc_code']);
$remark = "withdraw By " . $user;

$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
$date_zoon = date("H:i", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("d-m-Y", $timestamp);
$created_at = date("Y-m-d H:i:s");
$current_date = date("d-m-Y", $timestamp);
$current_time = date("h:i", $timestamp);
$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600;

$withdraw_setting = mysqli_query($conn, "SELECT * FROM app_controller");
$withdraw = mysqli_fetch_assoc($withdraw_setting);

$sqlq11 = mysqli_query($conn, "SELECT win_amount,mob FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
$row11 = mysqli_fetch_assoc($sqlq11);


if ($account_number == 'null' || $account_number == null || empty($account_number || !isset($account_number))) {
	$rows['success'] = '0';
	$rows['message'] = 'Plese enter Account number';
	echo (json_encode($rows));
	exit;
}
if ($ifsc_code == 'null' || $ifsc_code == null || empty($ifsc_code || !isset($ifsc_code))) {
	$rows['success'] = '0';
	$rows['message'] = 'Plese enter IFSC code';
	echo (json_encode($rows));
	exit;
}

if ($date_zoon >= $withdraw['withdraw_open_time'] && $date_zoon <= $withdraw['withdraw_close_time']) {

	if ($appId == '' || $dev_id == '' || $user == '' || $bal_req == '') {
		$rows['success'] = '0';
		$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
		echo (json_encode($rows));
		exit;

	} else {
		$checkUserWallet = mysqli_query($conn, "SELECT * FROM point_table WHERE user_id = $user AND tr_status='Success' AND tr_nature = 'TRWITH003' AND DATE(created_at)='".date('Y-m-d')."'");
		$row_checkUserWallet = mysqli_fetch_assoc($checkUserWallet);
		$count_checkUserWallet = mysqli_num_rows($checkUserWallet);

		if($count_checkUserWallet > 1){
			$rows['success'] = '2';
			$rows['message'] = "One Day 2 Time Withdraw Only!";
			echo (json_encode($rows));
			$conn->close();
			exit;
		}

		if($withdraw['withdraw_otp'] == 1){
			$mobileNum = $row11['mob'];
			$sql2 = mysqli_query($conn, "SELECT * FROM us_temp WHERE mobile='" . $mobileNum . "'");
			$otpdata = mysqli_fetch_assoc($sql2);
			if ($otpdata['otp'] != $otp) {
				$rows['success'] = '2';
				$rows['message'] = "Invailid Otp!";
				echo (json_encode($rows));
				$conn->close();
				exit;
			}
		}

		$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
		$row_chk_user = mysqli_fetch_assoc($chk_user);
		$count_chk_user = mysqli_num_rows($chk_user);


		$chk_controler = mysqli_query($conn, "SELECT * FROM app_controller WHERE  app_id = '" . $appId . "' AND admin_status = '1'");
		$row_ccontroler = mysqli_fetch_assoc($chk_controler);

		if ($count_chk_user > 0) {

			$userBal = $row_chk_user['win_amount'];
			$minRedeem = $row_ccontroler['min_redeem'];

			if ($bal_req >= $minRedeem) {
				if ($userBal >= $bal_req) {
					date_default_timezone_set('Asia/Kolkata');
					$UpdatedBalance = (int) $userBal - (int) $bal_req;
					$random = substr(md5(mt_rand()), 0, 10);
					if ($account_number == NULL && $ifsc_code == NULL) {
						$rows['success'] = '0';
						$rows['message'] = 'Plese enter Account number or IFSC';
						echo (json_encode($rows));
						exit;
					}

					if (empty($account_number) || empty($ifsc_code)) {
						$rows['success'] = '0';
						$rows['message'] = 'Please enter Account number or IFSC Code';
						echo json_encode($rows);
						exit;
					}

					$insertData1 = "INSERT INTO `point_table`( `app_id`, `user_id`, `transaction_id`, `tr_nature`,  `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `is_deleted`, `device_type`, `device_id`, `admin_key`, `game_type`,`created_at`,`account_no`,`ifsc_code`) VALUES ('$appId','$user','$random','TRWITH003','$bal_req','$UpdatedBalance','Withdraw','Debit','$devName','$date','$date_time','$remark','Pending','0','$devType','$devId','ADMIN0001', '1','$created_at','$account_number','$ifsc_code')";
					mysqli_query($conn, $insertData1);

					$chk_userbank = mysqli_query($conn, "SELECT * FROM user_bank_details WHERE  user_id = '" . $user . "'");
					$row_chk_userbank = mysqli_fetch_assoc($chk_userbank);

					$get_userbank = mysqli_query($conn, "SELECT account_no, ifsc_code, tr_value,id FROM point_table WHERE  user_id = '" . $user . "' ORDER BY id DESC");
					$row_get_userbank = mysqli_fetch_assoc($get_userbank);

					// if($row_chk_userbank['user_id'] == $user){
					// 	$get_userbank = mysqli_query($conn, "SELECT account_no, ifsc FROM user_bank_details WHERE  user_id = '" . $user . "'");
					// 	$row_get_userbank = mysqli_fetch_assoc($get_userbank);
					// 	// $rows['success'] = '1';
					// 	// $rows['message'] = 'User Bank Details Fetch Successfully';
					$rows['account_no'] = $row_get_userbank['account_no'];
					$rows['ifsc_code'] = $row_get_userbank['ifsc_code'];
					$rows['tr_value'] = $row_get_userbank['tr_value'];
					// 	// echo (json_encode($rows));
					// }else{
					// 	$insertuserbank = "INSERT INTO `user_bank_details`(`user_id`,`bank_name`,`account_holder`,`account_no`,`ifsc`) VALUE ('$user','','','$account_number','$ifsc_code')";
					// 	mysqli_query($conn, $insertuserbank);
					// }

					$updateBalance = "UPDATE us_reg_tbl SET win_amount = '$UpdatedBalance' Where user_id = '" . $user . "' AND app_id = '" . $appId . "'";
					mysqli_query($conn, $updateBalance);

					$rows['success'] = '1';
					$rows['message'] = 'Withdraw Request Successfully Created';
					echo (json_encode($rows));
					$conn->close();
					exit;

				} else {
					$rows['success'] = '2';
					$rows['message'] = 'Withdraw Request Failed OR InSufficient Balance';
					echo (json_encode($rows));
					$conn->close();
					exit;
				}
			} else {
				$rows['success'] = '4';
				$rows['message'] = 'Withdraw Request Failed OR Need Minimum ' . $minRedeem . ' Points In Your Wallet Your Balance is ' . $row_chk_user['credit'] . ' Earn More';
				echo (json_encode($rows));
				$conn->close();
				exit;
			}
		} else {
			$rows['success'] = '3';
			$rows['message'] = 'User Not Exits Or Blocked Please Check Again';
			echo (json_encode($rows));
			$conn->close();
			exit;

		}
	}
} else {
	$rows['success'] = '4';
	$rows['message'] = "Sorry You can withdraw only " . ' ' . date("h:i A", strtotime($withdraw['withdraw_open_time'])) . ' to ' . date("h:i A", strtotime($withdraw['withdraw_close_time']));
	echo (json_encode($rows));
	exit;
}

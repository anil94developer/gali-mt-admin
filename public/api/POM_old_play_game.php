<?php
include("config.php");
$params = (array) json_decode(file_get_contents('php://input'), TRUE);


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




// $user = $params['user_id'];
// $tblCode = $params['market_id'];
// $dev_id = $params['dev_id'];
// $appId = $params['app_id'];
// $bets = $params['BetList'];
// $date_time = date('Y-m-d H:i:s'); 
// $dev_model=$params['dev_model'];
// $bettype=$params['bettype'];

// $dev_name=$params['devName'];

$user = $_POST['user_id'];
$tblCode = $_POST['market_id'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
$bets = $_POST['BetList'];
$date_time = date('Y-m-d H:i:s');
$dev_model = $_POST['dev_model'];
$bettype = $_POST['bettype'];

$dev_name = $_POST['devName'];

$curntdate = date('Y-m-d');






if ($appId == '' || $dev_id == '' || $user == '') {
	$rows['success'] = '4';
	$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
	echo (json_encode($rows));
	exit;
} else {


	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);

	if ($count_chk_user > 0) {
		$length = 10;
		$tr_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
		$market_close_time = $market_data['time'] - 1;

		$amount = array();
		foreach ($bets as $key => $value) {
			$amount[] = $value['betamount'];
		}

		$amount = array_sum($amount);
		$sqlq = mysqli_query($conn, "SELECT credit FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
		$row = mysqli_fetch_assoc($sqlq);
		$balance = $row['credit'];

		if ($balance < $amount) {
			$rows['success'] = '6';
			$rows['message'] = "You don't Have sufficient Balance";
			echo (json_encode($rows));
			$conn->close();
			exit;
		}

		if ($tblCode == '') {

			$rows['success'] = '0';
			$rows['message'] = "Please select a bazaar to batting.";
			echo (json_encode($rows));
			$conn->close();
			exit;
		} else {



			$newbalance = ($balance - $amount);
			$insertquery = mysqli_query($conn, "update us_reg_tbl set credit ='" . $newbalance . "' WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
			$insertquery;

			foreach ($bets as $key => $value) {
				$betamount = $value['betamount'];
				$betkey = $value['betkey'];
				$betType = $value['bettype'];

				if (!empty($value)) {
					$sql = "INSERT INTO `point_table`(`game_type`, `app_id`, `admin_key`, `user_id`, `transaction_id`, `tr_nature`, `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `table_id`, `slot_id` , `pred_num`, `is_deleted`, `device_type`, `device_id`) VALUES ('$betType', '$appId', 'ADMIN0001', '$user', '$tr_id', 'TRGAME001', '$betamount', '$newbalance', 'Game', 'Debit', '$dev_model', '$date', '$date_time', '', 'Success', '$tblCode', '$timeId', '$betkey', '0', '','$dev_id') ";
					$res = mysqli_query($conn, $sql);
				}
			}

			$rows['success'] = '1';
			$rows['message'] = 'Game Played Successfully check in history';
			$rows['data']['credit'] = $newbalance;
			echo (json_encode($rows));
			$conn->close();
			exit;
		}

		// }else{
		// 				     
		// 		 $rows['success'] = '2';
		// 		 $rows['message'] = 'Selected Market Closed Please choose other market' ; 
		// 		 echo (json_encode($rows));
		// 		 exit;
		// }

	} else {
		$rows['success'] = '3';
		$rows['message'] = 'User Not Exits Or Blocked Please Check Again';
		echo (json_encode($rows));
		$conn->close();
		exit;
	}
}

<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("POM_config.php");
$devId = $_POST['dev_id'];
$appId = $_POST['app_id'];
$usrId = $_POST['user_id'];
$fltDate = $_POST['flt_date'];
$tblCode = $_POST['tbl_code'];
//include('qrcheck.php');

//$fltDate= date('Y-m-d',strtotime($fltDate));

if ($appId == '' || $devId == '' || $usrId == '') {
	$rows['success'] = "0";
	$rows['message'] = "Error Plaese Fill All Details";
	echo (json_encode($rows));
	exit;
} else {
	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $usrId . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);

	if ($count_chk_user > 0) {
		// $date = date('Y-m-d');
		// $twoDaysAgo = $date->format('Y-m-d');
		// $currentDate = new DateTime();
		// $currentDate->sub(new DateInterval('P2D'));
		// $twoDaysAgo = $currentDate->format('Y-m-d');
		// $sqler = mysqli_query($conn, "SELECT tr_value,tr_remark,date_time,is_transfer,value_update_by,table_id,tr_value_updated,tr_status,sleep(0.2) FROM `wallet_reports` WHERE  app_id = '" . $appId . "'  AND user_id = '" . $usrId . "' AND is_deleted = '0'  AND (tr_status = 'Success' OR tr_status = 'Pending') AND created_at >= DATE_SUB(NOW(), INTERVAL 2 DAY) ORDER BY id DESC");

		// Get the current date
		$currentDate = date('Y-m-d');

		// Get the date two days before the current date
		$twoDaysBefore = date('Y-m-d', strtotime('-7 days', strtotime($currentDate)));
		// Output the two days before date
		// echo $twoDaysBefore; die;

		// Now you can use $twoDaysAgo in your SQL query
		$sqler = mysqli_query($conn, "SELECT tr_value, tr_remark, date_time,date, is_transfer, value_update_by, table_id, tr_value_updated, tr_status, sleep(0.2) FROM `wallet_reports` WHERE app_id = '" . $appId . "'  AND user_id = '" . $usrId . "' AND is_deleted = '0' AND (tr_status = 'Success' OR tr_status = 'Pending') AND date_time >= '" . $twoDaysBefore . "'  ORDER BY id DESC");

		// echo "SELECT tr_value, tr_remark, date_time,`date`, is_transfer, value_update_by, table_id, tr_value_updated, tr_status, sleep(0.2) FROM `wallet_reports` WHERE app_id = '" . $appId . "'  AND user_id = '" . $usrId . "' AND is_deleted = '0' AND (tr_status = 'Success' OR tr_status = 'Pending') AND date >= '" . $twoDaysBefore . "' AND date <= '" . $currentDate . "' ORDER BY id DESC"; die;


		// $sqler = mysqli_query($conn, "SELECT tr_value,tr_remark,date_time,is_transfer,value_update_by,table_id,tr_value_updated,tr_status,sleep(0.2) FROM `wallet_reports` WHERE  app_id = '" . $appId . "'  AND user_id = '" . $usrId . "' AND is_deleted = '0'  AND (tr_status = 'Success' OR tr_status = 'Pending') ORDER BY id DESC limit 20");
		//tr_value,win_value,date,tr_remark,pred_num,game_type,value_update_by,is_result_declared

		$count = mysqli_num_rows($sqler);

		if ($count > 0) {
			$i = 0;
			while ($row2 = mysqli_fetch_assoc($sqler)) {

				$type = "";
				if ($row2['tr_remark'] == "redeemed") {
					$type = "Bonus";
				}

				if ($row2['is_transfer'] == null) {
					$row2['is_transfer'] = "";
				}
				//$row2['value_update_by']=$row2['value_update_by']."\n".$row2['tr_remark'];
				if ($row2['is_transfer'] == 1) {
					$row2['value_update_by'] = $row2['value_update_by'] . "\n" . $row2['tr_remark'];
				}

				if ($row2['value_update_by'] == "Game") {
					$row2['value_update_by'] = $row2['tr_remark'] . "\n" . $row2['table_id'];
				}

				if ($row2['tr_value_type'] == "Debit" and $row2['tr_nature'] == "TRGAME001") {
					$date1 = $row2['betExpTime'];
					$date2 = date('d-m-Y H:i');
					$timestamp1 = strtotime($date1);
					$timestamp2 = strtotime($date2);
					if ($timestamp1 > $timestamp2) {
						$row2['delStatus'] = 1;
					} else {
						$row2['delStatus'] = 0;
					}
				}

				if ($row2['value_update_by'] == "Deposit") {
					$row2['value_update_by'] = $row2['value_update_by'] . "\n" . $row2['tr_remark'];
				}

				$row2['date'] = date('d-m-Y h:i a', strtotime($row2['created_at']));
				//$row2['date_time']=date("d-m-Y H:i:s a",strtotime($row2['updated_at']));			   
				$table_id = $row2['game_type'];
				$trans_nature = $row2['tr_nature'];
				$market_id = $row2['table_id'];

				$tblcodeid = mysqli_query($conn, "SELECT * FROM `tbl_types` WHERE  app_id = '" . $appId . "' AND tbl_code = '" . $table_id . "'");
				$countid = mysqli_num_rows($tblcodeid);
				$tblcodeData = mysqli_fetch_assoc($tblcodeid);

				$trns_name = mysqli_query($conn, "SELECT * FROM `tr_type` WHERE  app_id = '" . $appId . "' AND tr_type_code = '" . $trans_nature . "'");
				$trncount = mysqli_num_rows($trns_name);
				$trnstypeName = mysqli_fetch_assoc($trns_name);

				$slot_name = mysqli_query($conn, "SELECT * FROM `comx_appmarkets` WHERE  app_id = '" . $appId . "' AND market_id = '" . $market_id . "'");
				$slot_count = mysqli_num_rows($slot_name);
				$slotData = mysqli_fetch_assoc($slot_name);

				$rows['success'] = "1";
				$rows['message'] = "PointData details success";
				$rows['winAmount'] = $row_chk_user['win_amount'];
				$rows['data'][$i]['value_update_by'] = $row2['value_update_by'];
				$rows['data'][$i]['date_time'] = date('d-m-Y H:i', strtotime($row2['date_time']));
				$rows['data'][$i]['tr_value'] = $row2['tr_value'];
				$rows['data'][$i]['tr_value_updated'] = $row2['tr_value_updated'];
				$rows['data'][$i]['tr_status'] = $row2['tr_status'];
				// $rows['data'][$i] = $row;

				// if ($countid > 0) {
				// 	$rows['data'][$i]['game_type'] = $tblcodeData['tbl_name'];
				// } else {
				// 	$rows['data'][$i]['game_type'] = 'Table Not Found';
				// }

				// if ($trncount > 0) {
				// 	$rows['data'][$i]['transaction_name'] = $trnstypeName['tr_type_name'];
				// } else {
				// 	$rows['data'][$i]['transaction_name'] = 'Other';
				// }

				// if ($slot_count > 0) {
				// 	$rows['data'][$i]['market_name'] = $slotData['market_name'];
				// } else {
				// 	$rows['data'][$i]['market_name'] = 'NFS';
				// }

				$i++;
			}

		} else {
			$rows['success'] = "0";
			$rows['message'] = "No data Available Or May Be Something went wrong";
			$rows['winAmount'] = $row_chk_user['win_amount'];
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
$thread = $conn->thread_id;
$conn->kill($thread);
echo (json_encode($rows));
$conn->close();
$conn->close();
$conn->close();
$conn->close();
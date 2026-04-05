<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With");

include("POM_config.php");
$devId = $_POST['dev_id'];
$appId = $_POST['app_id'];
$usrId = $_POST['user_id'];
$fltDate1 = $_POST['flt_date'];
$tblCode = $_POST['tbl_code'];
//include('qrcheck.php');
$fltDate = '';
if ($fltDate1) {
	if ($fltDate1 != 'undefined') {
		$fltDate = date('Y-m-d', strtotime($fltDate1));
	}

}
// die($fltDate);
// echo $flt_date; die;
// echo $devId. $appId; die;

// $fltDate= date('Y-m-d',strtotime($fltDate));

if ($appId == '' || $devId == '' || $usrId == '') {
	$rows['success'] = "0";
	$rows['message'] = "Error Plaese Fill All Details";
	echo (json_encode($rows));
	exit;
} else {
	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $usrId . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);
	// echo $fltDate; die;
	if ($count_chk_user > 0) {
		// echo"yyy";
		// die;
		if ($fltDate != '' && $tblCode == '') {
			//  echo $fltDate; die;
			$sqler = mysqli_query($conn, "SELECT  id,date_time,table_id,betExpTime,game_type,pred_num,is_result_declared,tr_value,win_value,value_update_by,tr_value_type,tr_nature FROM `point_table` WHERE  app_id = '" . $appId . "' AND user_id = '" . $usrId . "' AND is_deleted = '0' AND DATE(created_at) = '" . $fltDate . "' AND tr_nature IN('TRGAME001') ORDER BY created_at DESC");
		} else if (!$tblCode == '' && !$fltDate == '') {
			//   echo"yyyyyyyy";die;
// 		  	echo "SELECT id,date_time,table_id,betExpTime,game_type,is_result_declared,pred_num,tr_value,win_value,value_update_by,tr_value_type,tr_nature  FROM `point_table` WHERE  app_id = '" . $appId . "' AND user_id = '" . $usrId . "' AND is_deleted = '0' AND DATE(created_at) = '$fltDate' AND table_id = '$tblCode' AND tr_nature = 'TRGAME001' ORDER BY id DESC";
// 			die;
			$sqler = mysqli_query($conn, "SELECT id,date_time,table_id,betExpTime,game_type,is_result_declared,pred_num,tr_value,win_value,value_update_by,tr_value_type,tr_nature FROM `point_table` WHERE  app_id = '" . $appId . "' AND user_id = '" . $usrId . "' AND is_deleted = '0' AND DATE(created_at) = '$fltDate' AND table_id = '$tblCode' AND tr_nature IN('TRGAME001') ORDER BY created_at DESC");

		} else if (!$tblCode == '' && $fltDate == '') {
			//  echo$fltDate;die;
			//$sqler=mysqli_query($conn, "SELECT * FROM `point_table` WHERE  app_id = '".$appId ."' AND user_id = '".$usrId."'  AND is_deleted = '0' AND table_id = '$tblCode' AND tr_nature = 'TRGAME001' ORDER BY id DESC");
			$sqler = mysqli_query($conn, "SELECT id,date_time,table_id,betExpTime,game_type,pred_num,is_result_declared,tr_value,win_value,value_update_by,tr_value_type,tr_nature FROM `point_table` WHERE  app_id = '" . $appId . "' AND user_id = '" . $usrId . "'  AND is_deleted = '0' AND table_id = '$tblCode' AND tr_nature IN('TRGAME001') ORDER BY created_at DESC limit 10");
		} else {
			$days_ago = date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d'))));
			$dt = date('d-m-Y');
			$sqler = mysqli_query($conn, "SELECT id,date_time,table_id,betExpTime,game_type,pred_num,is_result_declared,tr_value,win_value,value_update_by,tr_value_type,tr_nature  FROM `point_table` WHERE  app_id = '" . $appId . "' AND user_id = '" . $usrId . "' AND is_deleted = '0' AND tr_nature IN('TRGAME001') AND DATE(created_at) >= '" . $days_ago . "' ORDER BY date_time DESC");
		}
		//tr_value,win_value,date,tr_remark,pred_num,game_type,value_update_by,is_result_declared
		//echo mysqli_error($conn); die;

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
					$date2 = date('Y-m-d H:i:s');
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

				$row2['date'] = date('d-m-Y h:i:s a', strtotime($row2['created_at']));
				//$row2['date_time']=date("d-m-Y H:i:s a",strtotime($row2['updated_at']));			   
				$table_id = $row2['game_type'];
				$trans_nature = $row2['tr_nature'];
				$market_id = $row2['table_id'];

				$tblcodeid = mysqli_query($conn, "SELECT * FROM `tbl_types` WHERE  app_id = '" . $appId . "' AND tbl_code = '" . $table_id . "'");
				$countid = mysqli_num_rows($tblcodeid);
				// die($countid);
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
				$rows['data'][$i] = $row2;

				if ($countid > 0) {
					$rows['data'][$i]['game_type'] = $tblcodeData['tbl_name'];
				} else {
					$rows['data'][$i]['game_type'] = 'Table Not Found';
				}

				if ($trncount > 0) {
					$rows['data'][$i]['transaction_name'] = $trnstypeName['tr_type_name'];
				} else {
					$rows['data'][$i]['transaction_name'] = 'Other';
				}

				if ($slot_count > 0) {
					$rows['data'][$i]['market_name'] = $slotData['market_name'];
				} else {
					$rows['data'][$i]['market_name'] = 'NFS';
				}

				$i++;
			}
		} else {
			$conn->close();
			$rows['success'] = "0";
			$rows['message'] = "No data Available Or May Be Something went wrong";
			$rows['winAmount'] = $row_chk_user['win_amount'];
			echo (json_encode($rows));
			exit;
		}
	} else {
		$conn->close();
		$rows['success'] = '3';
		$rows['message'] = 'User Not Exits Or Blocked Please Check Again';
		echo (json_encode($rows));
		exit;
	}
}
$thread = $conn->thread_id;
$conn->kill($thread);
$conn->close();
$conn->close();
$conn->close();
$conn->close();
echo (json_encode($rows));
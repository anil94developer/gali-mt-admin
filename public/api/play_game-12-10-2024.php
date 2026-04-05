<?php
// die;
// header('Access-Control-Allow-Origin: 3006');
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With");
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
// header('Access-Control-Allow-Headers: token, Content-Type');
// header('Access-Control-Max-Age: 1728000');
// header('Content-Length: 0');
// header('Content-Type: text/plain');

include("POM_config.php");
$params = (array) json_decode(file_get_contents('php://input'), TRUE);
// print_r($params);die;

date_default_timezone_set('Asia/Kolkata');
function check_time($market_id)
{

	$timestamp = time();
	$date = date("Y-m-d", $timestamp);
	date_default_timezone_set('Asia/Kolkata');
	global $conn;
	$sqler = mysqli_query($conn, "SELECT * FROM `comx_appmarkets` WHERE  market_id = '" . $market_id . "' ORDER BY market_position = 'ASC'");
	$sqlerww = mysqli_query($conn, "SELECT jodi_min, jodi_max FROM `app_controller`");
	$count = mysqli_num_rows($sqler);

	if ($count > 0) {
		$row2 = mysqli_fetch_assoc($sqler);
		$rowNew = mysqli_fetch_assoc($sqlerww);
		$marketOpenTime = $row2['market_view_time_open'];
		$marketCloseTime = date("H:i:s", strtotime($row2['market_view_time_close'] . " +1 minutes"));
		$mini_bet = $rowNew['jodi_min'];
		$max_bet = $rowNew['jodi_max'];

		$openTimeSec = strtotime($date . " " . $marketOpenTime) - strtotime($date);
		$closeTimeSec = strtotime($date . " " . $marketCloseTime) - strtotime($date);
		$currentTimeSec = time() - strtotime($date);
		$remainingTimeSec = $closeTimeSec - $currentTimeSec;
		// $betCloseSec = $remainingTimeSec - 60; // bet placing closed time
		$betCloseSec = $remainingTimeSec; // bet placing closed time
		$betChangeSec = $betCloseSec - 1800; // bet amount change time

		if ($betChangeSec < 0) {
			$betChangeSec = 0;
		}
		// echo $openTimeSec."=".$currentTimeSec. "=" .$closeTimeSec. "=" .$currentTimeSec. "=" .$betCloseSec;
		// die();
		if ($openTimeSec <= $currentTimeSec && $closeTimeSec > $currentTimeSec && $betCloseSec > 0) {
			// die("hello");
			$rows['success'] = "1";
			$rows['message'] = "Bet available";
			$rows['remaining_time_in_seconds'] = $remainingTimeSec;
			$rows['betpoint_change_time'] = $betChangeSec;
			$rows['isLimit'] = $row2['is_time_limit_applied'];

			if ($betChangeSec > 0 and $rows['isLimit'] == 1) {
				return 1;
			} else {
				return 2;
			}

		} elseif ($row2['market_id'] == 'DISAWAR') {
			//$marketOpenTime;
			//$marketCloseTime;
			$ctime = date('H:i');
			$ctime1 = date('d-m-Y h:i a');
			//if($ctime>=$marketOpenTime and $marketCloseTime<=$ctime)
			//{
			//echo date('H:i',strtotime("midnight"));
			///echo $cmn=(strtotime($ctime)<strtotime("midnight"))?1:0;

			if ((!(strtotime($ctime) >= strtotime("03:30")) or !(strtotime($ctime) <= strtotime("09:00")))) {
				if (strtotime($ctime) > strtotime("09:00") and strtotime($ctime) <= strtotime('23:59')) {
					$rangeEnd = strtotime("tomorrow 03:30 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 03:30 am") - strtotime($ctime1);
				}

				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;
					$rows['points'] = $row_chk_user['credit'];
					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1')
								   {
									   $rows['mini_bet'] = '5';
										$rows['max_bet'] = '200';
								   }else{*/

					return 2;
					//}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} elseif ($row2['market_id'] == 'SHIV') {
			//$marketOpenTime;
			//$marketCloseTime;
			$ctime = date('H:i');

			$ctime1 = date('d-m-Y h:i a');
			//if($ctime>=$marketOpenTime and $marketCloseTime<=$ctime)
			//{
			//echo date('H:i',strtotime("midnight"));
			///echo $cmn=(strtotime($ctime)<strtotime("midnight"))?1:0;

			if ((!(strtotime($ctime) >= strtotime("01:00")) or !(strtotime($ctime) <= strtotime("09:00")))) {
				if (strtotime($ctime) > strtotime("09:00") and strtotime($ctime) <= strtotime('23:59')) {
					$rangeEnd = strtotime("tomorrow 01:00 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 01:00 am") - strtotime($ctime1);
				}
				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;
					$rows['points'] = $row_chk_user['credit'];
					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
						$rows['mini_bet'] = '5';
						$rows['max_bet'] = '200';
					}else{*/
					return 2;
					//}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} elseif ($row2['market_id'] == 'MAFIY') {
			//$marketOpenTime;
			//$marketCloseTime;
			$ctime = date('H:i');
			$ctime1 = date('d-m-Y h:i a');
			//if($ctime>=$marketOpenTime and $marketCloseTime<=$ctime)
			//{
			//echo date('H:i',strtotime("midnight"));
			///echo $cmn=(strtotime($ctime)<strtotime("midnight"))?1:0;

			if ((!(strtotime($ctime) >= strtotime("02:45")) or !(strtotime($ctime) <= strtotime("09:00")))) {
				if (strtotime($ctime) > strtotime("09:00") and strtotime($ctime) <= strtotime('23:59')) {
					$rangeEnd = strtotime("tomorrow 02:45 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 02:45 am") - strtotime($ctime1);
				}

				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;
					$rows['points'] = $row_chk_user['credit'];
					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
						$rows['mini_bet'] = '5';
						$rows['max_bet'] = '200';
					}else{*/

					$rows['mini_bet'] = $mini_bet;
					$rows['max_bet'] = $max_bet;
					$rows['h_max_bet'] = $row2['h_max_limit'];
					return 2;
					//}
				} else {
					$rows['success'] = "0";
					$rows['message'] = "Bet Closed";
					return false;
				}
			} else {
				$rows['success'] = "0";
				$rows['message'] = "Bet Closed";
				return false;
			}
		} elseif ($row2['market_id'] == 'dubaiking') {
			//$marketOpenTime;
			//$marketCloseTime;
			$ctime = date('H:i');
			$ctime1 = date('d-m-Y h:i a');
			//if($ctime>=$marketOpenTime and $marketCloseTime<=$ctime)
			//{
			//echo date('H:i',strtotime("midnight"));
			///echo $cmn=(strtotime($ctime)<strtotime("midnight"))?1:0;

			if ((!(strtotime($ctime) >= strtotime("01:00")) or !(strtotime($ctime) <= strtotime("07:00")))) {
				if (strtotime($ctime) > strtotime("07:00") and strtotime($ctime) <= strtotime('23:59')) {
					$rangeEnd = strtotime("tomorrow 01:00 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 01:00 am") - strtotime($ctime1);
				}

				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;
					$rows['points'] = $row_chk_user['credit'];
					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
						$rows['mini_bet'] = '5';
						$rows['max_bet'] = '200';
					}else{*/

					$rows['mini_bet'] = $mini_bet;
					$rows['max_bet'] = $max_bet;
					$rows['h_max_bet'] = $row2['h_max_limit'];
					return 2;
					//}
				} else {
					$rows['success'] = "0";
					$rows['message'] = "Bet Closed";
					return false;
				}
			} else {
				$rows['success'] = "0";
				$rows['message'] = "Bet Closed";
				return false;
			}
		}
		 
		else {
			return false;
		}
	} else {
		return false;
	}
}
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
//print_r($params);
$user = $params['user_id'];
$tblCode = $params['market_id'];
$dev_id = $params['dev_id'];
$appId = $params['app_id'];
$bets = $params['BetList'];
$date_time = date('Y-m-d H:i:s');
$dev_model = $params['dev_model'];
$bettype = $params['bettype'];
$dev_name = $params['devName'];

$curntdate = date('Y-m-d');
$timecStatus = 0;
$cmt = check_time($tblCode);

// print_r($bets);die();

if ($cmt == false) {
	$rows['success'] = '3';
	$rows['message'] = "Bet has been closed";
	echo (json_encode($rows));
	exit;
} elseif ($cmt == 2) {
	$timecStatus = 1;
}
//die("hello");

if ($tblCode == "DISAWAR" or $tblCode == "SHIV" or $tblCode == "MAFIY" or $tblCode =="dubaiking") {
	$ctime = date('H:i');
	if (strtotime($ctime) <= strtotime('23:59')) {
		if ((strtotime($ctime) >= strtotime("03:30"))) {
			// $date_time = date('Y-m-d H:i:s', strtotime(' +1 day'));
			// $date = date('d-m-Y', strtotime(' +1 day'));
			$date_time = date('Y-m-d H:i:s');
			$date = date('d-m-Y');
		} else {
			//$date_time = date('Y-m-d H:i:s');
			//$date = date('d-m-Y');
			$date_time = date('Y-m-d H:i:s', strtotime(' -1 day'));
			$date = date('d-m-Y', strtotime(' -1 day'));
		}
	} else {
		$date_time = date('Y-m-d H:i:s');
		$date = date('d-m-Y');
	}
}

$expTime = date("Y-m-d H:i:s", strtotime("+10 minutes", strtotime($date_time)));
$betTime = date("Y-m-d H:i:s");

if ($appId == '' || $dev_id == '' || $user == '') {
	$rows['success'] = '4';
	$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
	echo (json_encode($rows));
	exit;
} else {
	// die;
	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);
	if ($count_chk_user > 0) {
		$length = 10;
		$tr_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
		$market_close_time = $market_data['time'] - 1;
		$amount = array();
		// die;
		if(empty($bets)){
			$rows['success'] = '6';
			$rows['message'] = "Please Check Minimum Bat Amount";
			echo (json_encode($rows));
			exit;
		}
		foreach ($bets as $key => $value) {
			$amount[] = $value['betamount'];
			if($value['bettype'] == "9"){

				$harafchk1 = mysqli_query($conn, "SELECT HarufMin,HarufMax FROM app_controller");
				$harafchk = mysqli_fetch_assoc($harafchk1);
				if($harafchk['HarufMin'] > $value['betamount']){
					$rows['success'] = '6';
					$rows['message'] = "Bet value '".$value['betamount']."' is below the minimum bet '".$harafchk['HarufMin']."'. Please check your input.";
					echo (json_encode($rows));
					$conn->close();
					exit;
				}
				if($harafchk['HarufMax'] < $value['betamount']){
					$rows['success'] = '6';
					$rows['message'] = "Bet value '".$value['betamount']."' is above the maximum bet '".$harafchk['HarufMax']."'. Please check your input.";
					echo (json_encode($rows));
					$conn->close();
					exit;
				}
// die;
			}
			if($value['bettype'] == "10"){
				$harafchk1 = mysqli_query($conn, "SELECT HarufMin,HarufMax FROM app_controller");
				$harafchk = mysqli_fetch_assoc($harafchk1);
				if($harafchk['HarufMin'] > $value['betamount']){
					$rows['success'] = '6';
					$rows['message'] = "Bet value '".$value['betamount']."' is below the minimum bet '".$harafchk['HarufMin']."'. Please check your input.";
					echo (json_encode($rows));
					exit;
				}
				if($harafchk['HarufMax'] < $value['betamount']){
					$rows['success'] = '6';
					$rows['message'] = "Bet value '".$value['betamount']."' is above the maximum bet '".$harafchk['HarufMax']."'. Please check your input.";
					echo (json_encode($rows));
					$conn->close();
					exit;
				}

			}
			// die;
			if($value['bettype'] == "8"){
				$harafchk1 = mysqli_query($conn, "SELECT jodi_min,jodi_max FROM app_controller");
				$harafchk = mysqli_fetch_assoc($harafchk1);
				if($harafchk['jodi_min'] > $value['betamount']){
					$rows['success'] = '6';
					$rows['message'] = "Bet value '".$value['betamount']."' is below the minimum bet '".$harafchk['jodi_min']."'. Please check your input.";
					echo (json_encode($rows));
					exit;
				}
				if($harafchk['jodi_max'] < $value['betamount']){
					$rows['success'] = '6';
					$rows['message'] = "Bet value '".$value['betamount']."' is above the maximum bet '".$harafchk['jodi_max']."'. Please check your input.";
					echo (json_encode($rows));
					$conn->close();
					exit;
				}

			}
		}
		$amount = array_sum($amount);
		// dd($amount);

		//echo "SELECT credit,win_amount  FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'"; die;

		$sqlq = mysqli_query($conn, "SELECT credit,win_amount  FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
		$row = mysqli_fetch_assoc($sqlq);
		$balance = (int) $row['credit'] + (int) $row['win_amount'];

		$credit = (int) $row['credit'];
		$win_amount = (int) $row['win_amount'];

		/*if(check_time($tblCode)==false){
			$rows['success'] = '3';
			$rows['message'] = "Bet has been closed";
			echo (json_encode($rows));
			exit;
		}*/
		$i = 0;
		foreach ($bets as $key => $value) {
			$i++;
			$betType = $value['bettype'];
		}

		/* 
			if($betType==1)
			{
				if($i>40){
					$rows['success'] = '3';
					$rows['message'] = "More than 40 jodi is not allowed";
					echo (json_encode($rows));
					exit;
				}
			}
				
			$chk_jodi=mysqli_query($conn, "SELECT * FROM `point_table` WHERE game_type='1' and user_id='".$user."' and table_id='".$tblCode."' and date='".$date."'");
			$chk_jodi1 = mysqli_num_rows($chk_jodi);
			if($chk_jodi1>=40){
				$rows['success'] = '3';
				$rows['message'] = "MOre than 40 jodi is not allowed";
				echo (json_encode($rows));
				exit;				
			}
			*/

		if ($balance < (int) $amount) {
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
			//update bonus start
			$comm = mysqli_query($conn, "SELECT ref_comm FROM app_controller");
			$comm = mysqli_fetch_assoc($comm);

			$chk_user11 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
			$row_chk_user11 = mysqli_fetch_assoc($chk_user11);
			$count_chk_user11 = mysqli_num_rows($chk_user11);

			$chk_user22 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "'  AND user_status = '1'");
			$row_chk_user22 = mysqli_fetch_assoc($chk_user22);
			$count_chk_user22 = mysqli_num_rows($chk_user22);

			//update bonus end
			////////
			// dd($balance);
			////////
				$newbalance = ((int) $balance - (int) $amount);
				$date_timew = date('Y-m-d H:i:s');
		        $datew = date('d-m-Y');

				$sql12 = "INSERT INTO `wallet_reports`(`transaction_id`,`game_type`,`type`, `value_update_by`,`user_id`,`app_id`,`tr_nature`, `tr_value`,`tr_value_updated`,  `date`, `date_time`,`tr_status`, `table_id`,`created_at`,`tr_remark`) VALUES ('$tr_id','$betType','Debit','Game','$user', '$appId','TRGAME001', '$amount','$newbalance','$date', '$date_time', 'Success', '$tblCode', '$date_time','Game Bet') ";
				mysqli_query($conn, $sql12);

			$cbalance = ((int) $credit - (int) $amount);
			if ($cbalance < 0) {
				$creditdeduct = 0;
				$windeduct = ((int) $amount - (int) $credit);
				$win_amount = $win_amount - $windeduct;

				mysqli_query($conn, "update us_reg_tbl set credit ='" . $creditdeduct . "',win_amount ='" . $win_amount . "' WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
			} 
			else {

				$windeduct = ((int) $credit - (int) $amount);
				mysqli_query($conn, "update us_reg_tbl set credit ='" . $windeduct . "' WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
			}
			foreach ($bets as $key => $value) {
				$betamount = trim($value['betamount']);
				$betkey = trim($value['betkey']);
				$betType = trim($value['bettype']);

				if (!empty($value)) {

					$sqlub = mysqli_query($conn, "SELECT credit FROM us_reg_tbl WHERE user_id ='" . $user . "'");
					$rowub = mysqli_fetch_assoc($sqlub);
					// $newbalance = (int)$rowub['credit']-(int)$betamount;
					// $insertquery =mysqli_query($conn,"update us_reg_tbl set credit ='".$newbalance."' WHERE user_id ='".$user."'");


					$unid = uniqid("db");
					$sql = "INSERT INTO `point_table`(`uniquid`,`game_type`, `app_id`, `admin_key`, `user_id`, `transaction_id`, `tr_nature`, `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `table_id`, `slot_id` , `pred_num`, `is_deleted`, `device_type`, `device_id`,`result_date`,`dateTime`,`betExpTime`,`betTime`,`betLimitStatus`) VALUES ('$unid','$betType', '$appId', 'ADMIN0001', '$user', '$tr_id', 'TRGAME001', '$betamount', '$newbalance', 'Game', 'Debit', '$dev_model', '$date', '$date_time', '', 'Success', '$tblCode', '$timeId', '$betkey', '0', '','$dev_id','$date','$date_time','$expTime','$betTime','$timecStatus') ";
					$res = mysqli_query($conn, $sql);

					$sql1 = "INSERT INTO `game_load`(`user_id`,`uniquid`,`game_type`, `transaction_id`,`app_id`,`tr_nature`, `tr_value`,  `date`, `date_time`,`tr_status`, `table_id`, `pred_num`,`created_at`)
	       			VALUES ('$user','$unid','$betType','$tr_id', '$appId','TRGAME001', '$betamount','$date', '$date_time', 'Success', '$tblCode', '$betkey', '$date_time')";
					$res = mysqli_query($conn, $sql1);
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
$conn->close();
$conn->close();
$conn->close();
$conn->close();
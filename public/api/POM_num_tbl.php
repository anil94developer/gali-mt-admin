<?php
include("POM_config.php");
date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date = date("Y-m-d", $timestamp);

$devId = $_POST['dev_id'];
$appId = $_POST['app_id'];
$market_id = $_POST['market_id'];
$userId = $_POST['user_id'];


if ($appId == '' && $userId == '' && $market_id == '') {

	$rows['success'] = "0";
	$rows['message'] = "Error Plaese Fill All Details";
	echo (json_encode($rows));
	exit;
} else {

	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $userId . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$count_chk_user = mysqli_num_rows($chk_user);
	$row_chk_user = mysqli_fetch_assoc($chk_user);

	if ($count_chk_user > 0) {
		$sqler = mysqli_query($conn, "SELECT * FROM `comx_appmarkets` WHERE  market_id = '" . $market_id . "' ORDER BY market_position = 'ASC'");
		$sqlerww = mysqli_query($conn, "SELECT jodi_min, jodi_max FROM `app_controller`");
		$count = mysqli_num_rows($sqler);

		if ($count > 0) {
			$row2 = mysqli_fetch_assoc($sqler);
			$rowNew = mysqli_fetch_assoc($sqlerww);
			$marketOpenTime = $row2['market_view_time_open'];
			// $marketCloseTime = $row2['market_view_time_close'];
			$marketCloseTime = date('H:i:s', strtotime('' . $row2['market_view_time_close'] . ' + 1 minutes'));
			$mini_bet = $rowNew['jodi_min'];
			$max_bet = $rowNew['jodi_max'];


			$openTimeSec = strtotime($date . " " . $marketOpenTime) - strtotime($date);
			$closeTimeSec = strtotime($date . " " . $marketCloseTime) - strtotime($date);
			$currentTimeSec = time() - strtotime($date);
			$remainingTimeSec = $closeTimeSec - $currentTimeSec;
			// $time_in_24_hour_format = date('H:i', strtotime(''.$time_in_24_hour_format21.' + 1 minutes'));
			// $betCloseSec = $remainingTimeSec - 60;      // bet placing closed time
			$betCloseSec = $remainingTimeSec;      // bet placing closed time
			$betChangeSec = $betCloseSec - 1800;		// bet amount change time

			if ($openTimeSec <= $currentTimeSec && $closeTimeSec > $currentTimeSec && $betCloseSec > 0) {
				$rows['success'] = "1";
				$rows['message'] = "Bet available";
				$rows['remaining_time_in_seconds'] = $remainingTimeSec;
				$rows['betpoint_change_time'] = $betChangeSec;
				$rows['points'] = $row_chk_user['credit'] + $row_chk_user['win_amount'];
				$rows['isLimit'] = $row2['is_time_limit_applied'];

				if ($betChangeSec <= 0 and $rows['isLimit'] == 1) {
					$rows['mini_bet'] = '5';
					$rows['max_bet'] = '200';
				} else {
					$rows['mini_bet'] = $mini_bet;
					$rows['max_bet'] = $max_bet;
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


				if ((!(strtotime($ctime) >= strtotime("03:30")) or !(strtotime($ctime) <= strtotime("07:00")))) {
					if (strtotime($ctime) > strtotime("07:00") and strtotime($ctime) <= strtotime('23:59')) {
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
						$rows['points'] = $row_chk_user['credit'] + $row_chk_user['win_amount'];
						$rows['isLimit'] = $row2['is_time_limit_applied'];

						/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
							$rows['mini_bet'] = '5';
							$rows['max_bet'] = '200';
						}else{*/

						$rows['mini_bet'] = $mini_bet;
						$rows['max_bet'] = $max_bet;
						//}
					} else {
						$rows['success'] = "0";
						$rows['message'] = "Bet Closed";
					}
				} else {
					$rows['success'] = "0";
					$rows['message'] = "Bet Closed";
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


				if ((!(strtotime($ctime) >= strtotime("03:20")) or !(strtotime($ctime) <= strtotime("07:00")))) {
					if (strtotime($ctime) > strtotime("07:00") and strtotime($ctime) <= strtotime('23:59')) {

						$rangeEnd = strtotime("tomorrow 03:20 am") - strtotime($ctime1);
					} else {
						$rangeEnd = strtotime("today 03:20 am") - strtotime($ctime1);
					}

					if ($rangeEnd != 0) {
						$betChangeSec = $rangeEnd - (30 * 60);
						$rows['success'] = "1";
						$rows['message'] = "Bet available";
						$rows['remaining_time_in_seconds'] = $rangeEnd;
						$rows['betpoint_change_time'] = $betChangeSec;
						$rows['points'] = $row_chk_user['credit'] + $row_chk_user['win_amount'];
						$rows['isLimit'] = $row2['is_time_limit_applied'];

						/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
							$rows['mini_bet'] = '5';
							$rows['max_bet'] = '200';
						}else{*/

						$rows['mini_bet'] = $mini_bet;
						$rows['max_bet'] = $max_bet;
						//}
					} else {
						$rows['success'] = "0";
						$rows['message'] = "Bet Closed";
					}
				} else {
					$rows['success'] = "0";
					$rows['message'] = "Bet Closed";
				}
			} elseif ($row2['market_id'] == 'SHIV') {
				//$marketOpenTime;
				// die($row2['market_id']);
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
						$rows['points'] = $row_chk_user['credit'] + $row_chk_user['win_amount'];
						$rows['isLimit'] = $row2['is_time_limit_applied'];

						/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
							$rows['mini_bet'] = '5';
							$rows['max_bet'] = '200';
						}else{*/

						$rows['mini_bet'] = $mini_bet;
						$rows['max_bet'] = $max_bet;
						//}
					} else {
						$rows['success'] = "0";
						$rows['message'] = "Bet Closed";
					}
				} else {
					$rows['success'] = "0";
					$rows['message'] = "Bet Closed";
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
						$rows['points'] = $row_chk_user['credit'] + $row_chk_user['win_amount'];
						$rows['isLimit'] = $row2['is_time_limit_applied'];

						/*if ($betChangeSec<=0 and $rows['isLimit']=='1'){
							$rows['mini_bet'] = '5';
							$rows['max_bet'] = '200';
						}else{*/

						$rows['mini_bet'] = $mini_bet;
						$rows['max_bet'] = $max_bet;
						$rows['h_max_bet'] = $row2['h_max_limit'];
						//}
					} else {
						$rows['success'] = "0";
						$rows['message'] = "Bet Closed";
					}
				} else {
					$rows['success'] = "0";
					$rows['message'] = "Bet Closed";
				}
			} else {
				$rows['success'] = "0";
				$rows['message'] = "Bet Closed";
			}
		} else {
			$rows['success'] = "0";
			$rows['message'] = "USER NOT FOUND";
		}

	}

}



echo (json_encode($rows));
$conn->close();
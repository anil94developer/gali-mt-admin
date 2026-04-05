<?php
include("POM_config.php");

// $rows['success'] = '0';
// $rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system' ; 
// echo (json_encode($rows));
// exit;
// die;


$user_id = $_POST['user_id'];
$appId = $_POST['app_id'];
$betid = $_POST['bet_id'];
date_default_timezone_set('Asia/Kolkata');


function check_time($market_id)
{

	$timestamp = time();
	$date = date("Y-m-d", $timestamp);
	date_default_timezone_set('Asia/Kolkata');
	global $conn;
	$sqler = mysqli_query($conn, "SELECT * FROM `comx_appmarkets` WHERE  market_id = '" . $market_id . "'");
	$sqlerww = mysqli_query($conn, "SELECT jodi_min, jodi_max FROM `app_controller`");
	$count = mysqli_num_rows($sqler);

	if ($count > 0) {

		$row2 = mysqli_fetch_assoc($sqler);
		$rowNew = mysqli_fetch_assoc($sqlerww);
		$marketOpenTime = $row2['market_view_time_open'];
		$marketCloseTime = $row2['market_view_time_close'];
		$mini_bet = $rowNew['jodi_min'];
		$max_bet = $rowNew['jodi_max'];


		$openTimeSec = strtotime($date . " " . $marketOpenTime) - strtotime($date);
		$closeTimeSec = strtotime($date . " " . $marketCloseTime) - strtotime($date);
		$currentTimeSec = time() - strtotime($date);
		$remainingTimeSec = $closeTimeSec - $currentTimeSec;
		$betCloseSec = $remainingTimeSec - 60;      // bet placing closed time
		$betChangeSec = $betCloseSec - 1800;		// bet amount change time

		if ($betChangeSec < 0) {
			$betChangeSec = 0;
		}
		if ($openTimeSec <= $currentTimeSec && $closeTimeSec > $currentTimeSec && $betCloseSec > 0) {
			//die("hello");
			$rows['success'] = "1";
			$rows['message'] = "Bet available";
			$rows['remaining_time_in_seconds'] = $remainingTimeSec;
			$rows['betpoint_change_time'] = $betChangeSec;
			//$rows['points'] = $row_chk_user['credit'];
			$rows['isLimit'] = $row2['is_time_limit_applied'];

			if ($betChangeSec <= 0 and $rows['isLimit'] == 1) {
				return true;
			} else {

				return true;
			}

		} elseif ($row2['market_id'] == 'DISAW') {
			//$marketOpenTime;
			//$marketCloseTime;
			$ctime = date('H:i');

			$ctime1 = date('d-m-Y h:i a');
			//if($ctime>=$marketOpenTime and $marketCloseTime<=$ctime)
			//{
			//echo date('H:i',strtotime("midnight"));
			///echo $cmn=(strtotime($ctime)<strtotime("midnight"))?1:0;


			if ((!(strtotime($ctime) >= strtotime("02:40")) or !(strtotime($ctime) <= strtotime("09:00")))) {
				if (strtotime($ctime) > strtotime("09:00") and strtotime($ctime) <= strtotime('23:59')) {

					$rangeEnd = strtotime("tomorrow 02:40 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 02:40 am") - strtotime($ctime1);
				}

				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;

					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1') {
												$rows['mini_bet'] = '5';
												$rows['max_bet'] = '200';
											}else{*/

					return true;
					//}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} elseif ($row2['market_id'] == 'SHIV ') {
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

					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1') {
												$rows['mini_bet'] = '5';
												$rows['max_bet'] = '200';
											}else{*/
					return true;
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

					$rows['isLimit'] = $row2['is_time_limit_applied'];

					/*if ($betChangeSec<=0 and $rows['isLimit']=='1') {
											 $rows['mini_bet'] = '5';
											 $rows['max_bet'] = '200';
										 }else{*/

					$rows['mini_bet'] = $mini_bet;
					$rows['max_bet'] = $max_bet;
					$rows['h_max_bet'] = $row2['h_max_limit'];
					return true;
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
		} else {

			return false;

		}
	} else {

		return false;

	}

}


if ($user_id == '' || $appId == '' || $betid == '') {

	$rows['success'] = '0';
	$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
	echo (json_encode($rows));
	exit;

} else {




	$sq12 = mysqli_query($conn, "SELECT betExpTime,betTime,app_id,table_id,tr_value,game_type,uniquid,transaction_id,pred_num FROM point_table WHERE  user_id='" . $user_id . "' and is_result_declared='0' and tr_nature='TRGAME001' and tr_value_type='Debit' and id='" . $betid . "'");
	$data = mysqli_fetch_assoc($sq12);

	if (check_time($data['table_id']) == false) {
		$rows['success'] = '3';
		$rows['message'] = "Market has been has been closed";
		echo (json_encode($rows));
		$conn->close();
		exit;
	}


	if (count($data) > 0) {




		$date1 = $data['betExpTime'];
		$date2 = date('Y-m-d H:i:s');
		$timestamp1 = strtotime($date1);
		$timestamp2 = strtotime($date2);
		if ($timestamp1 > $timestamp2) {

			$amount = $data['tr_value'];

			$chk_user = mysqli_query($conn, "SELECT credit,win_amount FROM us_reg_tbl WHERE user_id ='" . $user_id . "'");
			$row_chk_user = mysqli_fetch_assoc($chk_user);
			if (count($row_chk_user) > 0) {
				$updatedAmount = $row_chk_user['credit'] + $amount;
				$updatedAmount1 = ($row_chk_user['credit'] + $row_chk_user['win_amount']) + $amount;
				mysqli_query($conn, "update us_reg_tbl set credit='" . $updatedAmount . "' WHERE user_id ='" . $user_id . "'");

				mysqli_query($conn, "INSERT INTO deleted_bet SELECT * FROM point_table where id='" . $betid . "'");
				mysqli_query($conn, "update deleted_bet set deleted_by='user' WHERE id=" . $betid . "'");

				mysqli_query($conn, "delete from  game_load WHERE uniquid ='" . $data['uniquid'] . "'");
				mysqli_query($conn, "delete from  point_table WHERE id ='" . $betid . "'");

				$date12 = date('d-m-Y');
				$date11 = date('Y-m-d H:i:s');
				$userid = $user_id;


				$referenceId = $data['transaction_id'];
				$table_id = $data['table_id'];
				$pred_num = $data['pred_num'];

				$sql12 = "INSERT INTO `wallet_reports`(`type`,`pred_num`,`table_id`,`transaction_id`,`value_update_by`,`user_id`,`app_id`,`tr_nature`, `tr_value`,`tr_value_updated`,`date`,`date_time`,`tr_status`,`created_at`,`tr_remark`)
			   VALUES ('Credit',' $pred_num','$table_id','$referenceId','Deposit','$userid','com.dubaiking','TRREF006','$amount','$updatedAmount1','$date12','$date11','Success','$date11', 'Game Deleted') ";
				mysqli_query($conn, $sql12);


				$rows['success'] = '1';
				$rows['message'] = 'Delete Successfully';
				echo (json_encode($rows));
				$conn->close();
				exit;
			} else {
				$rows['success'] = '0';
				$rows['message'] = 'User not available';
				echo (json_encode($rows));
				$conn->close();
				exit;
			}


		} else {
			$rows['success'] = '0';
			$rows['message'] = 'Bet will be delete after 10 minutes of bet placed';
			echo (json_encode($rows));
			$conn->close();
			exit;

		}
	} else {
		$rows['success'] = '0';
		$rows['message'] = 'Bet not available';
		echo (json_encode($rows));
		$conn->close();
		exit;
	}

}







?>
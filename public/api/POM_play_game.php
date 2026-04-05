<?php
include("POM_config.php");

$params = (array) json_decode(file_get_contents('php://input'), TRUE);
date_default_timezone_set('Asia/Kolkata');
$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
$row_chk_user = mysqli_fetch_assoc($chk_user);
$count_chk_user = mysqli_num_rows($chk_user);
$batamt = $_POST['BetList'];
$bets = json_decode($batamt);
// foreach ($bets as $key => $value) {
// 	//   $amount[] =  $value->betamount;
// 	if ($value->betamount < 10) {
// 		$rows['success'] = '3';
// 		$rows['message'] = 'Min Rs 10 Bat';
// 		echo (json_encode($rows));
// 		exit;
// 	}

// }
function check_time($market_id)
{
	$timestamp = time();
	$date = date("Y-m-d", $timestamp);
	date_default_timezone_set('Asia/Kolkata');
	global $conn;
	// die($market_id);
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
		$betCloseSec = $remainingTimeSec - 60; // bet placing closed time
		$betChangeSec = $betCloseSec - 1800; // bet amount change time

		if ($betChangeSec < 0) {
			$betChangeSec = 0;
		}
		if ($openTimeSec <= $currentTimeSec && $closeTimeSec >= $currentTimeSec && $betCloseSec > 0) {
			// die("hello");
			$rows['success'] = "1";
			$rows['message'] = "Bet available";
			$rows['remaining_time_in_seconds'] = $remainingTimeSec;
			$rows['betpoint_change_time'] = $betChangeSec;
			$rows['points'] = $row_chk_user['credit'];
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


			if ((!(strtotime($ctime) >= strtotime("02:20")) or !(strtotime($ctime) <= strtotime("09:00")))) {

				if (strtotime($ctime) > strtotime("09:00") and strtotime($ctime) <= strtotime('23:59')) {

					$rangeEnd = strtotime("tomorrow 02:20 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 02:20 am") - strtotime($ctime1);
				}

				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;
					$rows['points'] = $row_chk_user['credit'];
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
		} elseif ($row2['market_id'] == 'KDMnight') {
			//$marketOpenTime;
			//$marketCloseTime;
			$ctime = date('H:i');

			$ctime1 = date('d-m-Y h:i a');
			//if($ctime>=$marketOpenTime and $marketCloseTime<=$ctime)
			//{
			//echo date('H:i',strtotime("midnight"));
			///echo $cmn=(strtotime($ctime)<strtotime("midnight"))?1:0;


			if ((!(strtotime($ctime) >= strtotime("12:40")) or !(strtotime($ctime) <= strtotime("07:00")))) {
				if (strtotime($ctime) > strtotime("07:00") and strtotime($ctime) <= strtotime('23:59')) {

					$rangeEnd = strtotime("tomorrow 12:40 am") - strtotime($ctime1);
				} else {
					$rangeEnd = strtotime("today 12:40 am") - strtotime($ctime1);
				}


				if ($rangeEnd != 0) {
					$betChangeSec = $rangeEnd - (30 * 60);
					$rows['success'] = "1";
					$rows['message'] = "Bet available";
					$rows['remaining_time_in_seconds'] = $rangeEnd;
					$rows['betpoint_change_time'] = $betChangeSec;
					$rows['points'] = $row_chk_user['credit'];
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
		} else {

			return false;

		}
	} else {
		// die('ppppppp');
		return false;

	}

}

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
// $user = $_POST['user_id'];
// $tblCode = $_POST['market_id'];
// $dev_id = $_POST['dev_id'];
// $appId = $_POST['app_id'];
// // $bets = [{"betkey":0,"betamount":"1","bettype":"1"}];
// $bets = $_POST['BetList'];
// $date_time = date('Y-m-d H:i:s'); 
// $dev_model=$_POST['dev_model'];
// $bettype=$_POST['bettype'];

// $dev_name=$_POST['devName'];
$user = $_POST['user_id'];
$tblCode = $_POST['market_id'];
$market_name_given = $_POST['market_name'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
// $bets = $_POST['BetList'];
$date_time = date('Y-m-d H:i:s');
$dev_model = $_POST['dev_model'];
$bettype = $_POST['bettype'];
$session = $_POST['session'];

$dev_name = $_POST['devName'];

$curntdate = date('Y-m-d');
$betamount = $_POST['betamount'];
$betkey = $_POST['betkey'];
$betType = $_POST['bettype'];
// var_dump($_POST);
// die('ppppppppppppppp');
// $curntdate = date('Y-m-d'); 
// die($_POST['market_id'].'ppp');
if (check_time($tblCode) == false) {
	$rows['success'] = '3';
	$rows['message'] = "Bet has been closed";
	echo (json_encode($rows));
	exit;
}
// die("hello");


if ($tblCode == "DISAW" or $tblCode == "KDMnight") {
	$ctime = date('H:i');
	if (strtotime($ctime) <= strtotime('23:59')) {
		if ((strtotime($ctime) >= strtotime("03:30"))) {
			$date_time = date('Y-m-d H:i:s');
			$date = date('d-m-Y');
			//$date_time=date('Y-m-d H:i:s', strtotime(' +1 day'));
			//$date=date('d-m-Y', strtotime(' +1 day'));
		} else {
			$date_time = date('Y-m-d H:i:s', strtotime(' -1 day'));
			$date = date('d-m-Y', strtotime(' -1 day'));

			//	$date_time=date('Y-m-d H:i:s');
			//$date=date('d-m-Y');

		}
	} else {
		//$date_time=date('Y-m-d H:i:s');
		//$date=date('d-m-Y');
		$date_time = date('Y-m-d H:i:s', strtotime(' -1 day'));
		$date = date('d-m-Y', strtotime(' -1 day'));
	}
}


if ($appId == '' || $dev_id == '' || $user == '') {
	$rows['success'] = '4';
	$rows['message'] = 'Invalid data inserted try again';
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
		// $rt = $bets;
		// $cars = ["betkey"=>"0", "betamount"=>"1", "bettype"=>"1"];
		$bets = json_decode($bets);
		// print_r($params);
		// die();

		foreach ($bets as $key => $value) {
			//   $amount[] =  $value->betamount;
			$amount[] = $value->betamount;
		}
		$amount = array_sum($amount);
		// print_r($amount);
		// die();

		$sqlq = mysqli_query($conn, "SELECT credit FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");
		$row = mysqli_fetch_assoc($sqlq);
		$balance = (int) $row['credit'];


		/*if(check_time($tblCode)==false){
				  $rows['success'] = '3';
				  $rows['message'] = "Bet has been closed" ;
				  echo (json_encode($rows));
				  exit;
			  }*/
		$i = 0;
		foreach ($bets as $key => $value) {
			$i++;
			$betType = $value->bettype;
			// $betType =  $value['bettype'];
		}

		/* 
						  if($betType==1)
						  {
							  if($i>40)
							  {
								   $rows['success'] = '3';
								   $rows['message'] = "More than 40 jodi is not allowed" ; 
								   echo (json_encode($rows));
								   exit;
							  }
						  }
							  
						  $chk_jodi=mysqli_query($conn, "SELECT * FROM `point_table` WHERE game_type='1' and user_id='".$user."' and table_id='".$tblCode."' and date='".$date."'");
						  $chk_jodi1 = mysqli_num_rows($chk_jodi);
						  if($chk_jodi1>=40){ 
								   $rows['success'] = '3';
								   
								   $rows['message'] = "MOre than 40 jodi is not allowed" ; 
								   echo (json_encode($rows));
								   exit;
							
						  }
						  */

		if ($balance < (int) $amount) {
			$rows['success'] = '6';
			$rows['message'] = "You don't Have sufficient Balance";
			echo (json_encode($rows));
			exit;

		}



		if ($tblCode == '') {

			$rows['success'] = '0';
			$rows['message'] = "Please select a bazaar to batting.";
			echo (json_encode($rows));
			exit;
		} else {
			//update bonus start
			$comm = mysqli_query($conn, "SELECT ref_comm FROM app_controller");
			$comm = mysqli_fetch_assoc($comm);

			$chk_user11 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE ref_code ='" . $row_chk_user['ref_by'] . "' AND app_id = '" . $appId . "' AND user_status = '1'");
			$row_chk_user11 = mysqli_fetch_assoc($chk_user11);
			$count_chk_user11 = mysqli_num_rows($chk_user11);

			$chk_user22 = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "'  AND user_status = '1'");
			$row_chk_user22 = mysqli_fetch_assoc($chk_user22);
			$count_chk_user22 = mysqli_num_rows($chk_user22);


			if ($count_chk_user11 > 0) {
				if ($row_chk_user11['user_type'] == "master") {
					$total_played = $row_chk_user11['total_played'] + $amount;
					$bonus = $row_chk_user11['ref_bonous'] + ($amount * $row_chk_user11['commission'] / 100);
				} else {
					$total_played = $row_chk_user11['total_played'] + $amount;
					$bonus = $row_chk_user11['ref_bonous'] + ($amount * $comm['ref_comm'] / 100);
				}
				mysqli_query($conn, "update us_reg_tbl set total_played ='" . $total_played . "',ref_bonous='" . $bonus . "' WHERE user_id ='" . $row_chk_user11['user_id'] . "' AND app_id = '" . $appId . "'");
			}

			$total_played1 = $row_chk_user22['my_played'] + $amount;
			//$bonus1=$row_chk_user22['ref_bonous']+($amount*$comm['ref_comm']/100);
			mysqli_query($conn, "update us_reg_tbl set my_played ='" . $total_played1 . "' WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "'");


			//update bonus end

			$newbalance = ($balance - $amount);
			$sql12 = "INSERT INTO `wallet_reports`(`transaction_id`,`game_type`,`type`, `value_update_by`,`user_id`,`app_id`,`tr_nature`, `tr_value`,`tr_value_updated`,  `date`, `date_time`,`tr_status`, `table_id`,`created_at`,`tr_remark`)
	       VALUES ('$tr_id','$betType','Debit','Game','$user', '$appId','TRGAME001', '$amount','$newbalance','$date', '$date_time', 'Success', '$tblCode', '$date_time','Game Bet') ";
			mysqli_query($conn, $sql12);

			//$insertquery =mysqli_query($conn,"update us_reg_tbl set credit ='".$newbalance."' WHERE user_id ='".$user."' AND app_id = '".$appId."'");


			foreach ($bets as $key => $value) {

				$betamount = $value->betamount;
				$betkey = $value->betkey;
				$betType = $value->bettype;

				// $betamount =  $value['betamount'];
				// $betkey =  $value['betkey'];
				// $betType =  $value['bettype'];


				if (!empty($value)) {
					$sqlub = mysqli_query($conn, "SELECT credit FROM us_reg_tbl WHERE user_id ='" . $user . "'");
					$rowub = mysqli_fetch_assoc($sqlub);

					$newbalance = $rowub['credit'] - $betamount;
					$insertquery = mysqli_query($conn, "update us_reg_tbl set credit ='" . $newbalance . "' WHERE user_id ='" . $user . "'");

					$sql = "INSERT INTO `point_table`(`game_type`, `app_id`, `admin_key`, `user_id`, `transaction_id`, `tr_nature`, `tr_value`, `tr_value_updated`, `value_update_by`, `tr_value_type`, `tr_device`, `date`, `date_time`, `tr_remark`, `tr_status`, `table_id`, `slot_id` , `pred_num`, `is_deleted`, `device_type`, `device_id`,`result_date`,`created_at`,`market_type`)
	       VALUES ('$betType', '$appId', 'ADMIN0001', '$user', '$tr_id', 'TRGAME001', '$betamount', '$newbalance', 'Game', 'Debit', '$dev_model', '$date', '$date_time', '', 'Success', '$tblCode', '$timeId', '$betkey', '0', '','$dev_id','$date','$date_time','mainMarket') ";
					$res = mysqli_query($conn, $sql);
					//   echo $sql;
					// die('ppp');
					$sql1 = "INSERT INTO `game_load`(`game_type`, `transaction_id`,`app_id`,`tr_nature`, `tr_value`,  `date`, `date_time`,`tr_status`, `table_id`, `pred_num`,`created_at`)
	       VALUES ('$betType','$tr_id', '$appId','TRGAME001', '$betamount','$date', '$date_time', 'Success', '$tblCode', '$betkey', '$date_time') ";
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
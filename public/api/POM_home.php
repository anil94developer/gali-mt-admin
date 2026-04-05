<?php
include("POM_config.php");
$appId = $_POST['app_id'];
$user_id = $_POST['user_id'];
$dev_id = $_POST['dev_id'];

/// Show Market only result has deculered ///

date_default_timezone_set('Asia/Kolkata');
$timestamp = time();
$date_time = date("d-m-Y (D) h:i:s A", $timestamp);
$nowdate_time = date("y-m-d H:i:s", $timestamp);
//echo "Current date and local time on this server is $date_time";
$date = date("Y-m-d", $timestamp);
$current_date = date("d-m-Y", $timestamp);
$current_date1 = date("d-m-Y");
// dd($current_date);
$current_time = date("h:i A", $timestamp);

$current_time_second = date("h:i:s", $timestamp);
$current_time_second_24hours = date("H:i:s", $timestamp);
$timeampm = date("A", $timestamp);
$currentTime = time() + 3600;

function random_strings($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result), 
                       0, $length_of_string);
}

if ($appId == '' && $user_id == '') {
	$rows['success'] = "0";
	$rows['message'] = "Error";
	echo (json_encode($rows));
	exit;
} else {

	$sql = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id='" . $user_id . "' AND app_id = '" . $appId . "'");
	$count = mysqli_num_rows($sql);
	if ($count > 0) {

		$appUserData = mysqli_fetch_assoc($sql);

		$allMarkets = mysqli_query($conn, "SELECT * FROM comx_appmarkets WHERE app_id = '" . $appId . "' AND status = '1' AND is_deleted = '0' ORDER BY market_position ASC");
		$countMarkets = mysqli_num_rows($allMarkets);
		$appControler = mysqli_query($conn, "SELECT * FROM app_controller WHERE app_id = '" . $appId . "'");
		$appControllerData = mysqli_fetch_assoc($appControler);

		if ($countMarkets > 0) {

			////get last updated market for currentday

			// $lastreslt = mysqli_query($conn, "SELECT * FROM results_tbls WHERE date ='" . $current_date . "' ORDER BY id DESC");
			$lastreslt = mysqli_query($conn, "SELECT * FROM results_tbls ORDER BY id DESC");
			$checkLastTodayMarket = mysqli_num_rows($lastreslt);

			if ($checkLastTodayMarket > 0) {
				$resultData = mysqli_fetch_assoc($lastreslt);
				
				$lastUpdated_marketId = $resultData['market_id'];
				$lastresult = $resultData['result'];
				$date_time_result = $resultData['date_time_result'];
				$checkNameLastMarket = mysqli_query($conn, "SELECT * FROM comx_appmarkets WHERE app_id = '" . $appId . "' AND market_id = '" . $lastUpdated_marketId . "'");
				$marketnameLast = mysqli_fetch_assoc($checkNameLastMarket);
				$market_name = $marketnameLast['market_name'];
				$market_sunday_time_open = $marketnameLast['market_sunday_time_open'];
			} else {
				$lastresult = 'Result Not Available';
				$market_id = ' Not Available';
				$market_name = ' Not Available';
				$date_time_result = ' Not Available';
			}

			$rows['success'] = "1";
			$rows['message'] = "Home dashboard Fetch Successfully";
			$rows['nformat'] = $date_time;
			$rows['current_date'] = $date;
			$rows['pid'] =  random_strings(45).random_strings(15);
			$rows['user_balance'] = $appUserData['credit'] + $appUserData['win_amount'];

			$rows['note'] = 'अगर आप referal कोड से अपने दोस्तो को जोड़ोगे तो आपका दोस्त जितनी गेम प्ले करेगा उसका 3 परसेंट आपको दिया जाएगा'; //$appControllerData['imp_notice_on_home'];


			$date_time_resultDate = date('d-m-Y',strtotime($date_time_result));
			$date_time_resultTime = date('h:i A',strtotime($date_time_result));
			$market_result_time = date('h:i A',strtotime($market_sunday_time_open));			

			$rows['current_market_details']['today_day'] = "Dubai King Today Results";
			$rows['current_market_details']['whatsap'] = $appControllerData['whatsapp'];
			$rows['current_market_details']['call'] = $appControllerData['call_enable'];
			$rows['current_market_details']['whatsapnum'] = $appControllerData['admin_contact_mob'];
			$rows['current_market_details']['market_name'] = $market_name;
			$rows['current_market_details']['market_id'] = $lastUpdated_marketId;
			$rows['current_market_details']['updated_date'] = $date_time_resultDate;
			$rows['current_market_details']['updated_time'] = $date_time_resultTime;
			$rows['current_market_details']['market_result'] = $lastresult;
			$rows['current_market_details']['market_result_time'] = $market_result_time;

			$i = 0;
			while ($marketData = mysqli_fetch_assoc($allMarkets)) {
				date_default_timezone_set('Asia/Calcutta');
				$market_id = $marketData['market_id'];

				$getRet = mysqli_query($conn, "SELECT result FROM results_tbls WHERE market_id = '" . $market_id . "' AND date = '" . $current_date . "'");
				$restdata = mysqli_fetch_assoc($getRet);
				$marketRes = $restdata['result'];
				if ($marketRes != '') {

					$rows['data'][$i]['market_result'] = $restdata['result'];
					$rows['data'][$i]['result_date_time'] = date('h:i A',strtotime($restdata['date_time_result']));
				} else {
					$rows['data'][$i]['market_result'] = "XX";
					$rows['data'][$i]['result_date_time'] = "00:00";
				}

				$pre_date = date('d-m-Y', strtotime('-1 day', strtotime($current_date)));
				$preRet = mysqli_query($conn, "SELECT result FROM results_tbls WHERE market_id = '" . $market_id . "' AND date = '" . $pre_date . "'");
				$prerestdata = mysqli_fetch_assoc($preRet);
				$premarketRes = $prerestdata['result'];
				if ($premarketRes != '') {
					$rows['data'][$i]['market_result_previous_day'] = $prerestdata['result'];
				} else {
					$rows['data'][$i]['market_result_previous_day'] = "XX";

				}
				
				$openTime = date('h:i A', strtotime($marketData['market_view_time_open']));
				$closeTime = date('h:i A', strtotime($marketData['market_sunday_time_close']));
				$resultTime = date('h:i A', strtotime($marketData['market_view_time_close']));
				$result_dateTime = date('h:i A', strtotime($resultData['date_time_result']));
				$market_result_time1 = date('h:i A',strtotime($marketData['market_sunday_time_open']));

				$rows['data'][$i]['market_name'] = $marketData['market_name'];
				$rows['data'][$i]['open_time'] = $openTime;
				$rows['data'][$i]['close_time'] = $closeTime;
				$rows['data'][$i]['result_time'] = $resultTime;
				$rows['data'][$i]['market_result_time'] = $market_result_time1;
				
				$rows['data'][$i]['is_open'] = '0';
				$rows['data'][$i]['market_id'] = $market_id;
				$rows['data'][$i]['mini_bet'] = '5';
				$rows['data'][$i]['max_bet'] = '200';
				$rows['data'][$i]['betpoint_change_time'] = '100';
				$i++;
			}
		} else {
			$rows['status'] = "0";
			$rows['message'] = "No Market Availavle For Play";
			echo (json_encode($rows));
			$conn->close();
			exit;
		}
	} else {
		$rows['status'] = "0";
		$rows['message'] = "User not Exits";
	}
}
echo (json_encode($rows));
$conn->close();
exit;

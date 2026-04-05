<?php
include("POM_config.php");

$user = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
// echo $user; die;
// echo $dev_id; die;
// echo $appId; die;

//var_dump($user.'<br>'.$dev_id.'<br>'.$appId );die;

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



if ($appId == '' || $dev_id == '' || $user == '') {

	$rows['success'] = '4';
	$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
	echo (json_encode($rows));
	exit;
} else {


	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");

	$row_chk_user = mysqli_fetch_assoc($chk_user);
	// print_r($row_chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);

	$genral_setting = mysqli_query($conn, "SELECT * FROM app_controller");

	$row_genral_setting = mysqli_fetch_assoc($genral_setting);

	$get_userbank = mysqli_query($conn, "SELECT account_no, ifsc_code,tr_value,id FROM point_table WHERE  user_id = '" . $user . "' AND tr_nature='TRWITH003' ORDER BY id DESC");
	$row_get_userbank = mysqli_fetch_assoc($get_userbank);

	if ($count_chk_user > 0) {

		$rows['success'] = '1';
		$rows['message'] = 'Profile Fetched Successfully';
		$rows['is_playstore'] = $row_chk_user['is_playstore'];
		$rows['credit'] = (int) $row_chk_user['credit'];
		$rows['user_status'] = $row_chk_user['user_status'];
		$rows['login_token'] = $row_chk_user['login_token'];
		$rows['banned'] = $row_chk_user['banned'];
		$rows['genral_setting_whatsapp'] = $row_genral_setting['whatsapp'];
		$rows['genral_setting_withdraw'] = $row_genral_setting['min_redeem'];
		$rows['account_no'] = $row_get_userbank['account_no'];
		$rows['ifsc_code'] = $row_get_userbank['ifsc_code'];
		$rows['tr_value'] = $row_get_userbank['tr_value'];

		$rows['refIsEnable'] = $row_chk_user['is_ref_enabled'];

		if ($row_chk_user['is_ref_enabled'] == '0') {
			$rows['refCode'] = '******';
			$rows['refmessage'] = "You need to enable Reffral first deposit and play then you are able to share Reffral Code";
		} else {

			$rows['refCode'] = $row_chk_user['ref_code'];


			$chekReffUser = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE ref_code = '" . $row_chk_user['ref_by'] . "' AND app_id = '" . $appId . "'");

			$count_chk_ref = mysqli_num_rows($chekReffUser);

			if ($count_chk_ref > 0) {
				$checkreffraldata = mysqli_fetch_assoc($chekReffUser);


				$rows['refByCode'] = $row_chk_user['ref_code'] . ' Reffer By ' . $checkreffraldata['FullName'];
			} else {

				$rows['refByCode'] = 'User not exits or blocked';
			}





			$rows['refmessage'] = "You are now able to share Reffral code to any other new friends";
		}
		$rows['name'] = $row_chk_user['FullName'];

		$rows['total_bonus'] = '0';
		$rows['total_sharings'] = '12';
		$rows['total_contrubution'] = '1234';

		$rows['mob'] = $row_chk_user['mob'];

		$chk_user11 = mysqli_query($conn, "SELECT upiId FROM app_controller");
		$row_chk_user11 = mysqli_fetch_assoc($chk_user11);
		$count_chk_user11 = mysqli_num_rows($chk_user11);
		$rows['upiId'] = $row_chk_user11['upiId'];
		echo (json_encode($rows));
		$conn->close();
		exit;
	} else {
		$rows['success'] = '3';
		$rows['message'] = 'User Not Exits Or Blocked Please Check Again';
		echo (json_encode($rows));
		$conn->close();
		exit;
	}
}

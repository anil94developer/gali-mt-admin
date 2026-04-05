<?php
include("POM_config.php");
$user = $_POST['user_id'];
$dev_id = $_POST['dev_id'];
$appId = $_POST['app_id'];
// ALTER TABLE app_controller CONVERT TO imp_notice_on_home SET utf8mb4 COLLATE utf8mb4_unicode_ci;

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

	$rows['success'] = '0';
	$rows['message'] = 'Invalid data iserted try again or if you more wrong try you will block by system';
	echo (json_encode($rows));
	exit;

} else {

	$chk_user = mysqli_query($conn, "SELECT * FROM us_reg_tbl WHERE user_id ='" . $user . "' AND app_id = '" . $appId . "' AND user_status = '1'");
	$row_chk_user = mysqli_fetch_assoc($chk_user);
	$count_chk_user = mysqli_num_rows($chk_user);

	if ($count_chk_user > 0) {

		$chk_sql = mysqli_query($conn, "SELECT * FROM app_controller WHERE app_id = '" . $appId . "' AND app_status = 'LIVE'");
		$count_data = mysqli_num_rows($chk_sql);

		if ($count_data > 0) {
			while ($row_data = mysqli_fetch_assoc($chk_sql)) {
				$rows['success'] = '1';
				$rows['message'] = 'Balance Fetched Successfully';
				$rows['data'] = $row_data;
			}
		} else {
			$rows['success'] = '2';
			$rows['message'] = 'Data Not Exits';
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
echo (json_encode($rows));


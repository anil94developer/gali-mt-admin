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

$chk_sql = mysqli_query($conn, "SELECT * FROM app_controller");
$count_data = mysqli_num_rows($chk_sql);

if ($count_data > 0) {
	while ($row_data = mysqli_fetch_assoc($chk_sql)) {
		$rows['success'] = '1';
		$rows['message'] = 'Balance Fetched Successfully';
		$rows['data'] = $row_data;
		$conn->close();
	}
} else {
	$rows['success'] = '2';
	$rows['message'] = 'Data Not Exits';
	echo (json_encode($rows));
	$conn->close();
	exit;
}

echo (json_encode($rows));
$conn->close();


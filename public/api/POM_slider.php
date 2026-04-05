<?php
include("dubaiking.php");

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

$sqluser = mysqli_query($conn, "SELECT * FROM banners");
$count = mysqli_num_rows($sqluser);

if ($count > 0) {
	$i = 0;
	$data = [];
	while ($row2 = mysqli_fetch_assoc($sqluser)) {
		$data[] = $row2;
		$i++;
	}
}
$url = "$baseurl" . "backend/uploads/banners/";
echo (json_encode(['status' => 1, 'message' => 'suceess', 'data' => $data, "Slider_url" => $url]));
$conn->close();
?>